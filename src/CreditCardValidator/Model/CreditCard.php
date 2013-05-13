<?php

namespace CreditCardValidator\Model;

use CreditCardValidator\Model\AbstractModel;

/**
 * Class CreditCard
 * @package CreditCardValidator\Model
 */
class CreditCard extends AbstractModel {

  protected $attributes = array(
    'number' => null
  );

  public function setNumber($number) {
    $this->attributes['number'] = $number;
  }

  public function getNumber() {
    return $this->attributes['number'];
  }

  /**
   * Strips all non-numeric characters from
   * the card number, including spaces and dashes
   *
   * @return float      Card number
   */
  public static function getNumberAsNormalizedString($number) {
    return (string) preg_replace("/[^0-9]/", "", $number);
  }
}