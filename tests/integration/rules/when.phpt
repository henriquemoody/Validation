--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IntValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::when(v::alwaysValid(), v::intVal())->check('abc');
} catch (IntValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::when(v::alwaysInvalid(), v::alwaysValid(), v::intVal())->check('def');
} catch (IntValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::when(v::alwaysValid(), v::not(v::intVal())))->check('ghi');
} catch (IntValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::when(v::alwaysInvalid(), v::alwaysValid(), v::not(v::intVal())))->check('jkl');
} catch (IntValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::when(v::alwaysValid(), v::intVal())->assert('mno');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::when(v::alwaysInvalid(), v::alwaysValid(), v::intVal())->assert('pqr');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::when(v::alwaysValid(), v::not(v::intVal())))->assert('stu');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::when(v::alwaysInvalid(), v::alwaysValid(), v::not(v::intVal())))->assert('vwx');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"abc" must be an integer number
"def" must be an integer number
"ghi" must not be an integer number
"jkl" must not be an integer number
- "mno" must be an integer number
- "pqr" must be an integer number
- "stu" must not be an integer number
- "vwx" must not be an integer number
