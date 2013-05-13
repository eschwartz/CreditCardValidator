<?php

namespace CreditCardValidator\Validator\Constraint;

use CreditCardValidator\Model\AbstractModel;

interface ConstraintInterface {
  /**
   * Validates the value
   *
   * @param (optional)      Value to validate
   * @return array          List of errors as ValidationErrorInterface objects
   */
  public function validate($value);
}