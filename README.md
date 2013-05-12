# Credit Card Validator

Validates Visa, MasterCard, and American Express credit card numbers.


## Installation

## Composer

This project using composer to generate a PSR-0 autoloader. Download and install composer at getcomposer.php into the project root directory, then run:

```
sudo ./composer.phar install
```


## Usage

$card = new CreditCard(array(
	'number' => "1234-abcd-sd&*(",
	'expDate' => "2012-04-03"
));
$card->setPropertyConstraint('number', new CreditCardNumberConstraint());

$validator = new Validator();
$errors = $validate($card);

$this->assertGreaterThan(0, count($errors));
$this->assertInstanceOf(CreditCardNumberValidationError, $errors[0])


## TODO:
* How to catch Fatal errors in testing scripts?

* Document unit tests
* Write functional test
* Install composer PSR-0 auto-loader
* Install php-unit
* TDD it
* Clean up UML for presentation

## BONUS:
* Generate documentation (PHPDoc)


## Tests to remember

- Multiple constraints on a property
- Multiple properties with constraints