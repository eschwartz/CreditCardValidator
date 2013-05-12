<?php

namespace CreditCardValidator\Tests\Model;

use CreditCardValidator\Model\CreditCard;

class CreditCardTest extends \PHPUnit_Framework_TestCase {
  private $card;

  public function setUp() {
    $this->card = new CreditCard();
  }

  public function tearDown() {
    unset($this->card);
  }

  public function testCanSetAndGetNumber() {
    $this->card->setNumber('12345');

    $this->assertEquals("12345", $this->card->getNumber());
  }

  public function testCanGetNormalizedCreditCardNumberAsFloat() {
    $this->card->setNumber("1234-5678 90abcd gef hij12.34\\56//7890");
    $normalized = $this->card->getNumberNormalized();
    $this->assertEquals("12345678901234567890", $normalized);
    $this->assertInternalType("float", $normalized);
  }
}