<?php
/**
 * Created by JetBrains PhpStorm.
 * User: edanschwartz
 * Date: 5/12/13
 * Time: 9:07 AM
 * To change this template use File | Settings | File Templates.
 */

namespace CreditCardValidator\Tests\Functional;

use CreditCardValidator\Validator\Validator;
use CreditCardValidator\Model\CreditCard;
use CreditCardValidator\Validator\Constraint\CreditCardNumberConstraint;
use CreditCardValidator\Validator\ValidationError\ValidationErrorInterface;

class CreditCardValidatorTest extends \PHPUnit_Framework_TestCase {
  /**
   * @dataProvider invalidCreditCardProvider
   */
  public function testShouldRenderErrorsForInvalidCreditCard($ccNumber) {
    $card = new CreditCard();
    $card->setNumber($ccNumber);
    $card->setPropertyConstraint('number', new CreditCardNumberConstraint());

    $validator = new Validator();
    $errors = $validator->validate($card);

    // Test that we got an error
    $this->assertEquals(1, count($errors));
    $this->assertInstanceOf("\\CreditCardValidator\\Validator\\ValidationError\\ValidationErrorInterface", $errors[0]);

    $this->assertEquals("That's just not a credit card number. Try again.", $errors[0]->renderErrorMsg());
  }

  /**
   * @dataProvider validCreditCardProvider
   */
  public function testShouldNotRenderErrorsForValidCreditCard($cardNumbers) {
    $validator = new Validator();

    foreach($cardNumbers as $cardType => $numbers) {
      foreach($numbers as $n) {
        $card = new CreditCard();
        $card->setNumber($n);
        $card->setPropertyConstraint('number', new CreditCardNumberConstraint(array($cardType)));
        $errors = $validator->validate($card);

        $this->assertEquals(0, count($errors));
      }
    }
  }

  /**
   * @dataProvider validCreditCardProvider
   */
  public function testShouldRenderErrorsForWrongCardType($cardNumbers) {
    $lastCardType = "discover";
    $validator = new Validator();

    foreach($cardNumbers as $cardType => $numbers) {
      foreach($numbers as $n) {
        $card = new CreditCard();
        $card->setNumber($n);

        // Try to validate with the last card type
        $card->setPropertyConstraint('number', new CreditCardNumberConstraint(array($lastCardType)));
        $errors = $validator->validate($card);

        $this->assertEquals(1, count($errors));
        $this->assertEquals(
          "You'd better check your credit card number again. It doesn't look like a $lastCardType, anyways.",
          $errors[0]->renderErrorMsg()
        );
      }
      $lastCardType = $cardType;
    }
  }

  public function invalidCreditCardProvider() {
    return array(
      array(
        'number' => "abc123"
      )
    );
  }

  public function validCreditCardProvider() {
    return array(
      'numbers' => array(
        array(
          'visa' => array(
            '4716-2871-1699-8188',
            '4485 1509 1624 5904',
            '4539030741341258',
          ),
          'mastercard' => array(
            '5219-3369-5341-1844',
            '5492 6203 1618 8068',
            '5115 4423 0582 6765',
          ),
          'amex' => array(
            '3411-1857-6609-208',
            '3735 5152 6821 237',
            '348722844702472',
          ),
          'discover' => array(
            '6011-4291-5318-6759',
            '6011 0485 8024 5317',
            '6011203944397219',
          )
        ),
      ),
    );
  }
}