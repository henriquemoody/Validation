--FILE--
<?php

require 'vendor/autoload.php';

$input = [
    'foo' => (object) [
        'bar' => 123,
    ],
];

exceptionMessage(static fn() => v::keyNested('foo.bar.baz')->assert(['foo.bar.baz' => false]));
exceptionMessage(static fn() => v::keyNested('foo.bar')->assert($input));
exceptionMessage(static fn() => v::keyNested('foo.bar')->assert(new ArrayObject($input)));
exceptionMessage(static fn() => v::keyNested('foo.bar', v::negative())->assert($input));
exceptionMessage(static fn() => v::keyNested('foo.bar')->assert($input));
exceptionMessage(static fn() => v::keyNested('foo.bar', v::stringType())->assert($input));
exceptionMessage(static fn() => v::keyNested('foo.bar.baz', v::notEmpty(), false)->assert($input));
exceptionMessage(static fn() => v::keyNested('foo.bar', v::floatType(), false)->assert($input));
?>
--EXPECTF--

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
foo must be present

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
No exception was thrown

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
No exception was thrown

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
bar must be a negative number

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
No exception was thrown

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
bar must be a string

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
No exception was thrown

Deprecated: The keyNested() rule is deprecated and will be removed in the next major version. Use nested key() or property() instead. %s
bar must be float
