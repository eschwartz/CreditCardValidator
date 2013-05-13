<?php
namespace CreditCardValidator\Validator\ValidationError;

/**
 * Validation errors are generated
 * when running validation on a constraint
 * against a model.
 *
 * Class ValidationErrorInterface
 * @package CreditCardValidator\Validator\ValidationError
 */
interface ValidationErrorInterface {
  /**
   * @return string   Error message
   */
  public function renderErrorMsg();
}