<?php

namespace CreditCardValidator\Model;

use CreditCardValidator\Validator\Constraint\ConstraintInterface;

abstract class Model {

  protected $attributes = array();

  protected $constraints = array();

  /**
   * Checks that the property is an attribute of the model
   * Or throws an exception
   *
   * @param $property
   * @throws \InvalidArgumentException
   */
  protected function checkPropertyExists($property) {
    if(!array_key_exists($property, $this->attributes)) {
      throw new \InvalidArgumentException("Unable to set property constraint. Property '$property' does not exist.");
    }
  }

  /**
   * Set a constraint on a model property
   * A property may have multiple constraints
   *
   * @param string $property                  An attribute of the model
   * @param ConstraintInterface $constraint   A constraint to apply to the model
   * @throws \InvalidArgumentException        If property is not an attribute of the model
   */
  public function setPropertyConstraint($property, ConstraintInterface $constraint) {
    $this->checkPropertyExists($property);

    if(isset($this->constraints[$property])) {
      array_push($this->constraints[$property], $constraint);
    }
    else {
      $this->constraints[$property] = array($constraint);
    }
  }

  /**
   * Returns an array of constraints bound the specified model property
   *
   * @param string $property                An attribute of the model
   * @return array                          An array of constraints bound to the model property
   * @throws \InvalidArgumentException      If property is not an attribute of the model
   */
  public function getPropertyConstraints($property) {
    $this->checkPropertyExists($property);

    return isset($this->constraints[$property])? $this->constraints[$property]: array();
  }
}