<?php

namespace CreditCardValidator\Tests\ValidationError;

use CreditCardValidator\Validator\ValidationError\CreditCardValidationError;

class CreditCardValidationErrorTest extends \PHPUnit_Framework_TestCase {
  public function testCanSetAndGetCardType() {
    $error = new CreditCardValidationError();
    $error->setCardType("visa");

    $this->assertEquals("visa", $error->getCardType());
  }

  public function testCanSetCardTypeOnConstruction() {
    $error = new CreditCardValidationError("mastercard");

    $this->assertEquals("mastercard", $error->getCardType());
  }

  public function testShouldNotRenderWithoutDefinedCardType() {
    $this->setExpectedException("InvalidArgumentException");

    $error = new CreditCardValidationError();
    $error->renderErrorMsg();
  }

  public function testShouldRenderErrorMsg() {
    $error = new CreditCardValidationError();
    $error->setCardType("amex");

    $this->assertInternalType("string", $error->renderErrorMsg());
  }
}