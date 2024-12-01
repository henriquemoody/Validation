--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::iterableType(), null],
    'Inverted' => [v::not(v::iterableType()), [1, 2, 3]],
    'With template' => [v::iterableType(), null, 'Not an iterable at all'],
    'With name' => [v::iterableType()->setName('Options'), null],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
`null` must be of type iterable
- `null` must be of type iterable
[
    'iterableType' => '`null` must be of type iterable',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
`[1, 2, 3]` must not of type iterable
- `[1, 2, 3]` must not of type iterable
[
    'notIterableType' => '`[1, 2, 3]` must not of type iterable',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not an iterable at all
- Not an iterable at all
[
    'iterableType' => 'Not an iterable at all',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
Options must be of type iterable
- Options must be of type iterable
[
    'iterableType' => 'Options must be of type iterable',
]
