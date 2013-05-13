<?php

namespace CreditCardValidator\Validator\Constraint;

use CreditCardValidator\Model\AbstractModel;

/**
 * A constraint can be bound to a model property
 * Validating the constraint shoudl return a list
 * of ValidationErrors
 *
 * Class ConstraintInterface
 * @package CreditCardValidator\Validator\Constraint
 */
interface ConstraintInterface {
  /**
   * Validates the value
   *
   * @param (optional)      Value to validate
   * @return array          List of errors as ValidationErrorInterface objects
   */
  public function validate($value);
}