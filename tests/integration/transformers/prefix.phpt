--FILE--
<?php

require 'vendor/autoload.php';

run([
    'key' => [v::keyEquals('foo', 12), ['foo' => 10]],
    'length' => [v::lengthGreaterThan(3), 'foo'],
    'max' => [v::maxOdd(), [1, 2, 3, 4]],
    'min' => [v::minEven(), [1, 2, 3]],
    'not' => [v::notBetween(1, 3), 2],
    'nullOr' => [v::nullOrBoolType(), 'string'],
    'property' => [v::propertyBetween('foo', 1, 3), (object) ['foo' => 5]],
    'undefOr' => [v::undefOrUrl(), 'string'],
]);
?>
--EXPECT--
key
⎺⎺⎺
foo must be equal to 12
- foo must be equal to 12
[
    'foo' => 'foo must be equal to 12',
]

length
⎺⎺⎺⎺⎺⎺
The length of "foo" must be greater than 3
- The length of "foo" must be greater than 3
[
    'lengthGreaterThan' => 'The length of "foo" must be greater than 3',
]

max
⎺⎺⎺
As the maximum of `[1, 2, 3, 4]`, 4 must be an odd number
- As the maximum of `[1, 2, 3, 4]`, 4 must be an odd number
[
    'maxOdd' => 'As the maximum of `[1, 2, 3, 4]`, 4 must be an odd number',
]

min
⎺⎺⎺
As the minimum from `[1, 2, 3]`, 1 must be an even number
- As the minimum from `[1, 2, 3]`, 1 must be an even number
[
    'minEven' => 'As the minimum from `[1, 2, 3]`, 1 must be an even number',
]

not
⎺⎺⎺
2 must not be between 1 and 3
- 2 must not be between 1 and 3
[
    'notBetween' => '2 must not be between 1 and 3',
]

nullOr
⎺⎺⎺⎺⎺⎺
"string" must be a boolean or must be null
- "string" must be a boolean or must be null
[
    'nullOrBoolType' => '"string" must be a boolean or must be null',
]

property
⎺⎺⎺⎺⎺⎺⎺⎺
foo must be between 1 and 3
- foo must be between 1 and 3
[
    'foo' => 'foo must be between 1 and 3',
]

undefOr
⎺⎺⎺⎺⎺⎺⎺
"string" must be a URL or must be undefined
- "string" must be a URL or must be undefined
[
    'undefOrUrl' => '"string" must be a URL or must be undefined',
]
