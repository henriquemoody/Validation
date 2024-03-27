--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::alwaysInvalid()->check('whatever'));
exceptionFullMessage(static fn() => v::alwaysInvalid()->assert(''));
?>
--EXPECT--
"whatever" is always invalid
- "" is always invalid
