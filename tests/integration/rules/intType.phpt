--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::intType()->check(new stdClass()));
exceptionMessage(static fn() => v::not(v::intType())->check(42));
exceptionFullMessage(static fn() => v::intType()->assert(INF));
exceptionFullMessage(static fn() => v::not(v::intType())->assert(1234567890));
?>
--EXPECT--
`stdClass {}` must be of type integer
42 must not be of type integer
- `INF` must be of type integer
- 1234567890 must not be of type integer
