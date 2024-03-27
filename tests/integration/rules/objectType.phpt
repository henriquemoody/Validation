--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::objectType()->check([]));
exceptionMessage(static fn() => v::not(v::objectType())->check(new stdClass()));
exceptionFullMessage(static fn() => v::objectType()->assert('test'));
exceptionFullMessage(static fn() => v::not(v::objectType())->assert(new ArrayObject()));
?>
--EXPECT--
`[]` must be of type object
`stdClass {}` must not be of type object
- "test" must be of type object
- `ArrayObject { getArrayCopy() => [] }` must not be of type object
