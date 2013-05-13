<?php

namespace CreditCardValidator\Validator;

use CreditCardValidator\Model\AbstractModel;

/**
 *
 * Class Validator
 * @package CreditCardValidator\Validator
 */
class Validator {

  /**
   * @var array  List of validation errors generated during validation
   */
  private $errors = array();

  /**
   * @var AbstractModel
   */
  private $model;

  protected function setModel(AbstractModel $model) {
    $this->model = $model;
  }

  /**
   * Runs through all bound constraints
   * on model properties, validates,
   * and returns a single list of validation errors
   * 
   * @param AbstractModel $model            The model to validate
   * @return array                          A list of validation errors
   */
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