--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::even()->assert(-1));
exceptionFullMessage(static fn() => v::even()->assert(5));
exceptionMessage(static fn() => v::not(v::even())->assert(6));
exceptionFullMessage(static fn() => v::not(v::even())->assert(8));
?>
--EXPECT--
-1 must be an even number
- 5 must be an even number
6 must not be an even number
- 8 must not be an even number
