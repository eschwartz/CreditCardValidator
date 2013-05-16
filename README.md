# Credit Card Validator

Validates Visa, MasterCard, and American Express credit card numbers.


## Installation

### Using Composer

This project uses composer to generate a PSR-0 autoloader. [Download and install](http://getcomposer.org) composer into the project root directory, then run:

```
sudo ./composer.phar install
```


## Usage

```
$card = new CreditCard()
$card->setNumbder("1234-abcd-sd&*);
$card->setPropertyConstraint('number', new CreditCardNumberConstraint());

$validator = new Validator();
$errors = $validate($card);

$this->assertGreaterThan(0, count($errors));
$this->assertInstanceOf(CreditCardNumberValidationError, $errors[0])

$errors[0]->renderErrorMsg();     // Returns a clever error message
```

## Extending

The validation component included in this package was made to be easily extended. For example, to validate credit card dates, you could

* Create a `AfterTodaysDateConstraint` class, which implements the `ConstraintInterface`
* Set a `validate` method on the constraint, which accepts a date, and returns an array of `ViolationErrorInterface` objects if the date is earlier that today.

You could then set this constraint on the CreditCardModel's date property:

```
$card->setPropertyConstraint('expDate', new AfterTodaysDateConstraint());
```

Not that you could also creat new models extending the `AbstractModel` class, and validate with the same components. For example, you could end up with something like:

```
$event = new TheEventModelWhichYouCreatedThatExtendsAbstractModel();
$event->setDate("March 08, 2007");
$event->setPropertyConstraint('date', new AfterTodaysDateConstraint());

$validator = new Validator();
$errors = $validator->validate($event);

```

## Testing

This component is unit- and functional-tested using PHPUnit. All test currently pass, running PHP 5.4.10. 

Please unit test your pull requests before submitting.