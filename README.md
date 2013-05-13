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
$card = new CreditCard(array(
	'number' => "1234-abcd-sd&*(",
	'expDate' => "2012-04-03"
));
$card->setPropertyConstraint('number', new CreditCardNumberConstraint());

$validator = new Validator();
$errors = $validate($card);

$this->assertGreaterThan(0, count($errors));
$this->assertInstanceOf(CreditCardNumberValidationError, $errors[0])

$errors[0]->renderErrorMsg();     // Returns a clever error message
```

## Extending

The validation component included in this package was made to be easily extended. For example, to validate credit card dates, you could

* Create a `CreditCardDateConstraint` class, which implements the `ConstraintInterface`
* Set a `validate` method on the constraint, which accepts a date, and returns an array of `ViolationErrorInterface` objects if the date is earlier that today.

You could also create new models extending the `AbstractModel` class, and validate with the same components.

## Testing

This component is unit- and functional-tested using PHPUnit. All test currently pass, running PHP 5.4.10. 

Please unit test your pull requests before submitting.