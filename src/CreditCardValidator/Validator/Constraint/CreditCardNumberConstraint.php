<?php
namespace CreditCardValidator\Validator\Constraint;

use CreditCardValidator\Validator\Constraint\ConstraintInterface;
use CreditCardValidator\Validator\ValidationError\CreditCardValidationError;

class CreditCardNumberConstraint implements ConstraintInterface {

  /**
   * @var array  Card types to test against
   */
  private $cardTypes = array();

  /**
   * Regular expressions for matching credit card numbers
   * Shamelessly stolen from http://www.regular-expressions.info/creditcard.html
   *
   * @var array
   */
  private $cardNumberPatterns = array(
    'visa'        => '/^4[0-9]{12}(?:[0-9]{3})?$/',
    'mastercard'  => '/^5[1-5][0-9]{14}$/',
    'amex'        => '/^3[47][0-9]{13}$/',
    'discover'    => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
    'any'         => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
  );

  public function checkDefinedCardTypes($cardTypes) {
    foreach($cardTypes as $type) {
      // Check for a matching card type
      if(!array_key_exists($type, $this->cardNumberPatterns)) {
        throw new \InvalidArgumentException("No credit card regex pattern exists for card type $type");
      }
    }
  }

  public function __construct(array $cardTypes = array('any')) {
    $this->checkDefinedCardTypes($cardTypes);
    $this->cardTypes = $cardTypes;
  }

  /**
   * @param array $cardTypes    Card types to test against
   */
  public function setCardTypes(array $cardTypes) {
    $this->checkDefinedCardTypes($cardTypes);
    $this->cardTypes = $cardTypes;
  }

  /**
   * @return array    Card types to test against
   */
  public function getCardTypes() {
    return $this->cardTypes;
  }

  /**
   * Validate a credit card number
   *
   * @param $number                             Credit card number to validate
   * @return array                              Array of CreditCardValidationError objects
   * @throws \InvalidArgumentException          If card type does not have defined pattern.
   */
  public function validate($number) {
    $valid = false;
    $errors = array();

    foreach($this->cardTypes as $type) {
      // Match card number against pattern
      $pattern = $this->cardNumberPatterns[$type];
      if(preg_match($pattern, $number)) {
        $valid = true;
      }
      else {
        array_push($errors, new CreditCardValidationError($type));
      }
    }

    return $valid ? array() : $errors;
  }
}