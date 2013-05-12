<?php

namespace CreditCardValidator\Model;

use CreditCardValidator\Model\Model as BaseModel;

class CreditCard extends BaseModel {

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
  public function getNumberNormalized() {
    return (float) preg_replace("/[^0-9]/", "", $this->getNumber());
  }
}