--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default' => [v::betweenExclusive(1, 10), 12],
    'Inverted' => [v::not(v::betweenExclusive(1, 10)), 5],
    'With template' => [v::betweenExclusive(1, 10), 12, 'Bewildered bees buzzed between blooming begonias'],
    'With name' => [v::betweenExclusive(1, 10)->setName('Range'), 10],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
12 must be greater than 1 and less than 10
- 12 must be greater than 1 and less than 10
[
    'betweenExclusive' => '12 must be greater than 1 and less than 10',
]

Inverted
⎺⎺⎺⎺⎺⎺⎺⎺
5 must not be greater than 1 or less than 10
- 5 must not be greater than 1 or less than 10
[
    'notBetweenExclusive' => '5 must not be greater than 1 or less than 10',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Bewildered bees buzzed between blooming begonias
- Bewildered bees buzzed between blooming begonias
[
    'betweenExclusive' => 'Bewildered bees buzzed between blooming begonias',
]

With name
⎺⎺⎺⎺⎺⎺⎺⎺⎺
Range must be greater than 1 and less than 10
- Range must be greater than 1 and less than 10
[
    'betweenExclusive' => 'Range must be greater than 1 and less than 10',
]
