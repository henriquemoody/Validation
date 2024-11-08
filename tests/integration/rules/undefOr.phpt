--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::undefOr(v::alpha()), 1234],
    'Default with many children' => [v::undefOr(v::alpha()->lowercase()), 1234],
    'Negative with many children' => [v::not(v::undefOr(v::alpha()->lowercase()->startsWith('a'))), 'alpha'],
    'Negative wrapper' => [v::not(v::undefOr(v::alpha())), 'alpha'],
    'Negative wrapped' => [v::undefOr(v::not(v::alpha())), 'alpha'],
    'Negative undefined' => [v::not(v::undefOr(v::alpha())), null],
    'Negative undefined, wrapped name' => [v::not(v::undefOr(v::alpha()->setName('Wrapped'))), null],
    'Negative undefined, wrapped name' => [v::not(v::undefOr(v::alpha())->setName('Wrapper')), null],
    'Negative undefined, not name' => [v::not(v::undefOr(v::alpha()))->setName('Not'), null],
    'With template' => [v::undefOr(v::alpha()), 123, 'Underneath the undulating umbrella'],
    'With array template' => [v::undefOr(v::alpha()), 123, ['undefOrAlpha' => 'Undefined number of unique unicorns']],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be undefined
- 1234 must contain only letters (a-z) or must be undefined
[
    'undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined',
]

Default with many children
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be undefined
- All of the required rules must pass for 1234
  - 1234 must contain only letters (a-z) or must be undefined
  - 1234 must be lowercase or must be undefined
[
    '__root__' => 'All of the required rules must pass for 1234',
    'alpha' => '1234 must contain only letters (a-z) or must be undefined',
    'lowercase' => '1234 must be lowercase or must be undefined',
]

Negative with many children
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) and must not be undefined
- These rules must not pass for "alpha"
  - "alpha" must not contain letters (a-z) and must not be undefined
  - "alpha" must not be lowercase and must not be undefined
  - "alpha" must not start with "a" and must not be undefined
[
    '__root__' => 'These rules must not pass for "alpha"',
    'alpha' => '"alpha" must not contain letters (a-z) and must not be undefined',
    'lowercase' => '"alpha" must not be lowercase and must not be undefined',
    'startsWith' => '"alpha" must not start with "a" and must not be undefined',
]

Negative wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) and must not be undefined
- "alpha" must not contain letters (a-z) and must not be undefined
[
    'notUndefOrAlpha' => '"alpha" must not contain letters (a-z) and must not be undefined',
]

Negative wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) or must be undefined
- "alpha" must not contain letters (a-z) or must be undefined
[
    'undefOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be undefined',
]

Negative undefined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The value must not be undefined
- The value must not be undefined
[
    'notUndefOr' => 'The value must not be undefined',
]

Negative undefined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be undefined
- Wrapper must not be undefined
[
    'notUndefOr' => 'Wrapper must not be undefined',
]

Negative undefined, not name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be undefined
- Not must not be undefined
[
    'notUndefOr' => 'Not must not be undefined',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Underneath the undulating umbrella
- Underneath the undulating umbrella
[
    'undefOrAlpha' => 'Underneath the undulating umbrella',
]

With array template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Undefined number of unique unicorns
- Undefined number of unique unicorns
[
    'undefOrAlpha' => 'Undefined number of unique unicorns',
]
