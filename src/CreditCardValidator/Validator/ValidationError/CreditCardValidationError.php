<?php

namespace CreditCardValidator\Validator\ValidationError;

use CreditCardValidator\Validator\ValidationError\ValidationErrorInterface;

/**
 * Class CreditCardValidationError
 * @package CreditCardValidator\Validator\ValidationError
 */
class CreditCardValidationError implements ValidationErrorInterface {

  /**
   * @var string  Type of card (eg. visa, mastercard, amex)
   */
  private $cardType;

  /**
   * @param null $cardType
   */
  public function __construct($cardType = null) {
    $this->cardType = $cardType;
  }

  /**
   * @param string $cardType    Card Type (eg. visa, mastercard, amex)
   */
  public function setCardType($cardType) {
    $this->cardType = $cardType;
  }

  /**
   * @return string
   */
  public function getCardType() {
    return $this->cardType;
  }

  public function renderErrorMsg() {
    if(!isset($this->cardType)) {
      throw new \InvalidArgumentException("CreditCardValidationError instance must have a card type defined.");
    }

    if($this->cardType === "any") {
      return "That's just not a credit card number. Try again.";
    }

    return "You'd better check your credit card number again. It doesn't look like a " . $this->cardType . ", anyways.";
  }
}