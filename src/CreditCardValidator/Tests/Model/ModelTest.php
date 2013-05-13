<?php

namespace CreditCardValidator\Tests\Model;

use CreditCardValidator\Tests\Fixtures\Model\TestModel as Model;

class ModelTest extends \PHPUnit_Framework_TestCase {

  private $model;

  private $card;

  public function setUp() {
    $this->model = new Model();
  }

  public function tearDown() {
    unset($this->model);
  }

  private function getDummyConstraint() {
    return $this->getMock("CreditCardValidator\\Validator\\Constraint\\ConstraintInterface");
  }

  public function testCanSetAndGetPropertyConstraints() {
    $this->model->setFoo('bar');

    $dummyConstraint = $this->getDummyConstraint();
    $this->model->setPropertyConstraint('foo', $dummyConstraint);
    $propertyConstraints = $this->model->getPropertyConstraints('foo');

    $this->assertEquals(1, count($propertyConstraints));
    $this->assertEquals($dummyConstraint, $propertyConstraints[0]);
  }

  public function testCanSetAndGetMultipleConstraintsOnASingleProperty() {
    $this->model->setFoo('bar');

    $dummyConstraintA = $this->getDummyConstraint();
    $dummyConstraintB = $this->getDummyConstraint();

    $this->model->setPropertyConstraint('foo', $dummyConstraintA);
    $this->model->setPropertyConstraint('foo', $dummyConstraintB);

    $propertyConstraints = $this->model->getPropertyConstraints('foo');
    $this->assertEquals(2, count($propertyConstraints));
  }

  public function testCanSetAndGetMultipleConstraintsOnMultipleProperties() {
    $this->model->setFoo('bar');
    $this->model->setSomeProperty('someValue');

    $dummyConstraintA = $this->getDummyConstraint();
    $dummyConstraintB = $this->getDummyConstraint();

    $this->model->setPropertyConstraint('foo', $dummyConstraintA);
    $this->model->setPropertyConstraint('foo', $dummyConstraintB);
    $this->model->setPropertyConstraint('someProperty', $dummyConstraintA);
    $this->model->setPropertyConstraint('someProperty', $dummyConstraintB);

    $allConstraints = $this->model->getConstraints();

    $this->assertInternalType("array", $allConstraints['foo']);
    $this->assertInternalType("array", $allConstraints['someProperty']);

    $this->assertEquals(2, count($allConstraints['foo']));
    $this->assertEquals(2, count($allConstraints['someProperty']));
  }

  public function testCannotSetConstraintForNonProperty() {
    $this->setExpectedException("InvalidArgumentException");
    $this->model->setPropertyConstraint('somePropertyOfWhichWeDoubtTheExistence', $this->getDummyConstraint());
  }

  public function testCannotSetNonConstraint() {
    $this->setExpectedException("Exception");

    $this->model->setFoo('bar');
    $this->model->setPropertyConstraint('foo', 'not a constraint, but rather a string');
  }
}