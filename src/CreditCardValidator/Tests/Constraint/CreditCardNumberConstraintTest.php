<?php

namespace CreditCardValidator\Tests\Constraint;

use CreditCardValidator\Validator\Constraint\CreditCardNumberConstraint;

class CreditCardNumberConstraintTest extends \PHPUnit_Framework_TestCase {

  private $constraint;

  // From http://www.darkcoding.net/credit-card-numbers/
  private $fakeCardNumbers = array(
    'visa'       => '4716287116998188',
    'mastercard' => '5219336953411844',
    'amex'       => '341118576609208',
    'discover'   => '6011429153186759',
  );

  public function setUp() {
    $this->constraint = new CreditCardNumberConstraint();
  }

  public function tearDown() {
    unset($this->constraint);
  }

  public function testCanSetAndGetCardTypes() {
    $this->constraint->setCardTypes(array('visa', 'amex'));

    $this->assertEquals(array('visa', 'amex'), $this->constraint->getCardTypes());
  }

  public function testSetCardTypesInConstructor() {
    $constraint = new CreditCardNumberConstraint(array('amex', 'visa'));

    $this->assertEquals(array('amex', 'visa'), $constraint->getCardTypes());
  }

  public function testCannotSetUndefinedCardTypes() {
    $this->setExpectedException("InvalidArgumentException");

    $this->constraint->setCardTypes(array("FreeMoneyCard"));
  }

  public function testInvalidNumberShouldReturnArrayOfErrors() {
    $errors = $this->constraint->validate("1234567890");
    $this->assertInternalType("array", $errors);
    $this->assertEquals(1, count($errors));
    $this->assertInstanceOf("\\CreditCardValidator\\Validator\\ValidationError\\ValidationErrorInterface", $errors[0]);
  }

  public function testValidCardsShouldNotReturnErrors() {
    foreach($this->fakeCardNumbers as $name => $number) {
      $errors = $this->constraint->validate($number, array($name));
      $assertMsg = "Fake $name card number should pass validation";
      $this->assertEquals(0, count($errors), $assertMsg);
    }
  }

  public function testAnyCardTypeShouldValidateWhenUsing_Any_Option() {
    foreach($this->fakeCardNumbers as $name => $number) {
      $errors = $this->constraint->validate($number, array('any'));
      $assertMsg = "Fake $name card number should pass validation, when using 'any' option";
      $this->assertEquals(0, count($errors), $assertMsg);
    }
  }

  public function testWrongCardTypeShouldReturnError() {
    $this->constraint->setCardTypes(array('visa'));
    $errors = $this->constraint->validate($this->fakeCardNumbers['mastercard']);

    $this->assertEquals(1, count($errors));
  }

  public function testShouldValidateAgainstMultipleCardTypes() {
    $this->constraint->setCardTypes(array('visa', 'amex'));
    $this->assertEquals(0, count($this->constraint->validate($this->fakeCardNumbers['visa'])));

    $this->constraint->setCardTypes(array('visa', 'amex'));
    $this->assertEquals(0, count($this->constraint->validate($this->fakeCardNumbers['amex'])));

    $this->constraint->setCardTypes(array('visa', 'amex'));
    $this->assertEquals(2, count($this->constraint->validate($this->fakeCardNumbers['mastercard'])));
  }
}