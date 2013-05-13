<?php

namespace CreditCardValidator\Model;

use CreditCardValidator\Model\AbstractModel;

class CreditCard extends AbstractModel {

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
  public function getNumberAsNormalizedString() {
    return (string) preg_replace("/[^0-9]/", "", $this->getNumber());
  }
}