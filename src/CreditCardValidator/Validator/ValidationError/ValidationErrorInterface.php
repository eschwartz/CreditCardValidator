<?php
namespace CreditCardValidator\Validator\ValidationError;

interface ValidationErrorInterface {
  /**
   * @return string   Error message
   */
  public function renderErrorMsg();
}