--FILE--
<?php

require 'vendor/autoload.php';

$array = ['foo' => true, 'bar' => 42];

exceptionMessage(static fn() => v::key('baz')->assert($array));
exceptionMessage(static fn() => v::not(v::key('foo'))->assert($array));
exceptionMessage(static fn() => v::key('foo', v::falseVal(), true)->assert($array));
exceptionMessage(static fn() => v::not(v::key('foo', v::trueVal(), true))->assert($array));
exceptionMessage(static fn() => v::key('foo', v::falseVal(), false)->assert($array));
exceptionMessage(static fn() => v::not(v::key('foo', v::trueVal(), false))->assert($array));
?>
--EXPECTF--

Deprecated: Calling key() without a second parameter has been deprecated, and will be not be allowed in the next major version. Use keyExists() instead. %s
baz must be present

Deprecated: Calling key() without a second parameter has been deprecated, and will be not be allowed in the next major version. Use keyExists() instead. %s
foo must not be present

Deprecated: Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use key() without it the third parameter. %s
foo must evaluate to `false`

Deprecated: Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use key() without it the third parameter. %s
foo must not evaluate to `true`

Deprecated: Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use keyOptional() instead. %s
foo must evaluate to `false`

Deprecated: Calling key() with a third parameter has been deprecated, and will be not be allowed in the next major version. Use keyOptional() instead. %s
foo must not evaluate to `true`
