--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$validator = v::not(
    v::not(
        v::not(
            v::not(
                v::not(
                    v::intVal()->positive()
                )
            )
        )
    )
);

exceptionMessage(static fn() => $validator->check(2));
exceptionFullMessage(static fn() => $validator->assert(2));
?>
--EXPECT--
2 must not be an integer number
- These rules must not pass for 2
  - 2 must not be an integer number
  - 2 must not be positive
