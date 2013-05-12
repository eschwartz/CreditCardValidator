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
}