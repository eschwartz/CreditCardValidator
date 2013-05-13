<?php

namespace CreditCardValidator\Tests;

use CreditCardValidator\Validator\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Validator
   */
  private $validator;

  public function setUp() {
    $this->validator = new Validator();
  }

  public function tearDown() {
    unset($this->validator);
  }

  public function testShouldReturnErrorsWithInvalidModel() {
    $model = $this->getMockConstrainedModel($isValid = false);
    $errors = $this->validator->validate($model);

    $this->assertGreaterThan(0, count($errors));
  }

  public function testShouldReturnNoErrorsWithValidModel() {
    $model = $this->getMockConstrainedModel($isValid = true);
    $errors = $this->validator->validate($model);

    $this->assertEquals(0, count($errors));
  }

  public function testShouldReturnTheCorrectNumberOfErrors() {
    $model = $this->getMockConstrainedModel($isValid = false);
    $errors = $this->validator->validate($model);

    // This is just a static count based on how my
    // mock objects are structured.
    // A more sustainable approach would be to accept an
    // `errorCount` param on the getMockConstrainedModel method.
    $expectedCount = 8;
    $this->assertEquals(8, count($errors));
  }

  private function getMockConstrainedModel($isValid, $errorCount = 1) {
    $model =  $this->getMock("CreditCardValidator\\Model\\AbstractModel");
    $model->expects($this->any())
      ->method('getConstraints')
      ->will($this->returnValue($this->getMockPropertyConstraints($isValid)));

    // Note that return value of 'getAttribute' method is empty
    // As constraint is mocked to always return true/false
    // (we are not testing the constraint itself, but the validator)
    $model->expects($this->any())
      ->method('getAttribute')
      ->will($this->returnValue(''));

    return $model;
  }

  private function getMockPropertyConstraints($isValid) {
    return array(
      'foo' => array(
        $this->getMockConstraint($isValid),
        $this->getMockConstraint($isValid),
      ),
      'someProperty' => array(
        $this->getMockConstraint($isValid),
        $this->getMockConstraint($isValid),
      ),
    );
  }

  private function getMockConstraint($isValid) {
    $mockErrors = $isValid ? array() : array(
      $this->getMockValidationError(),
      $this->getMockValidationError(),
    );

    $mockConstraint = $this->getMock("CreditCardValidator\\Validator\\Constraint\\ConstraintInterface");

    $mockConstraint->expects($this->any())
      ->method('validate')
      ->will($this->returnValue($mockErrors));

    return $mockConstraint;
  }

  public function getMockValidationError() {
    $mockError = $this->getMock("CreditCardValidator\\Validator\\ValidationError\\ValidationErrorInterface");
    return $mockError;
  }
}