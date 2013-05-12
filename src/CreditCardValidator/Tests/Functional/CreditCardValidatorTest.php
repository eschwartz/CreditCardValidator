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

class CreditCardValidatorTest extends \PHPUnit_Framework_TestCase {
  /**
   * @dataProvider invalidCreditCard
   */
  public function testShouldReturnErrorsForInvalidCardNumber($invalidData) {
    /*$card = new CreditCard($invalidData);
    $card->setPropertyConstraint('number', new CreditCardNumberConstraint);

    $validator = new Validator();
    $errors = $validator->validate($card);

    $this->assertEquals(1, count($errors), "Validator should return errors on a credit card with an invalid number");
    $this->assertInstanceOf(\CreditCardValidator\Validator\ValidationError\ValidationErrorInterface, $errors[0]);*/
  }

  public function invalidCreditCard() {
    return array(
      array(
        'number' => "abc123",
        "expDate" => "2013-12-03"
      )
    );
  }
}