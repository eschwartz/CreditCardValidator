<?php
/**
 * Bootstrap file for CreditCardValidator component
 *
 * Includes composer PSR-0 autoloader
 */

$autoloadPath = __DIR__ . "/vendor/autoload.php";

if(file_exists($autoloadPath)) {
  $loader = require_once $autoloadPath;

  return $loader;
}
else {
  throw new \RuntimeException('Could not find autoload.php -- make sure you run composer!');
}