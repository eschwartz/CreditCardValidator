<?php

namespace CreditCardValidator\Validator;

use CreditCardValidator\Model\AbstractModel;

class Validator {

  private $errors = array();

  private $model;

  protected function setModel(AbstractModel $model) {
    $this->model = $model;
  }

  public function validate(AbstractModel $model) {
    $errors = array();
    $constrainedProperties = $model->getConstraints();

    foreach($constrainedProperties as $attr => $constraints) {
      foreach($constraints as $constr) {
        $errors = array_merge($errors, $constr->validate($model->getAttribute($attr)));
      }
    }

    $this->setModel($model);

    return $this->errors = $errors;
  }
}