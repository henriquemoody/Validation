--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::trueVal()->assert(false));
exceptionMessage(static fn() => v::not(v::trueVal())->assert(1));
exceptionFullMessage(static fn() => v::trueVal()->assert(0));
exceptionFullMessage(static fn() => v::not(v::trueVal())->assert('true'));
?>
--EXPECT--
`false` must evaluate to `true`
1 must not evaluate to `true`
- 0 must evaluate to `true`
- "true" must not evaluate to `true`
