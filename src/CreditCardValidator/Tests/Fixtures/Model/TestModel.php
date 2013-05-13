<?php

namespace CreditCardValidator\Tests\Fixtures\Model;

use CreditCardValidator\Model\AbstractModel;

class TestModel extends AbstractModel {
  public function setFoo($value) {
    $this->attributes['foo'] = $value;
  }

  public function getFoo() {
    return $this->attributes['foo'];
  }
}