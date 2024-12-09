--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::between(1, 2)->assert(0));
exceptionMessage(static fn() => v::not(v::between('yesterday', 'tomorrow'))->assert('today'));
exceptionFullMessage(static fn() => v::between('a', 'c')->assert('d'));
exceptionFullMessage(static fn() => v::not(v::between(-INF, INF))->assert(0));
exceptionFullMessage(static fn() => v::not(v::between('a', 'b'))->assert('a'));
exceptionFullMessage(static fn() => v::not(v::between(1, 42))->assert(41));
?>
--EXPECT--
0 must be between 1 and 2
"today" must not be between "yesterday" and "tomorrow"
- "d" must be between "a" and "c"
- 0 must not be between `-INF` and `INF`
- "a" must not be between "a" and "b"
- 41 must not be between 1 and 42
