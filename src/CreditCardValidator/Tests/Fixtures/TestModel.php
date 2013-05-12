<?php

namespace CreditCardValidator\Tests\Fixtures;

use CreditCardValidator\Model\Model;

class TestModel extends Model {
  public function setFoo($value) {
    $this->attributes['foo'] = $value;
  }

  public function getFoo() {
    return $this->attributes['foo'];
  }
}