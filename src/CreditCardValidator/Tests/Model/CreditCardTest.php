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
}