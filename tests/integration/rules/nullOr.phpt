--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

run([
    'Default' => [v::nullOr(v::alpha()), 1234],
    'Default with many' => [v::nullOr(v::alpha()->uppercase()->startsWith('a')), 1234],
    'Negative with many' => [v::not(v::nullOr(v::alpha()->lowercase()->startsWith('a'))), 'alpha'],
    'Negative wrapper' => [v::not(v::nullOr(v::alpha())), 'alpha'],
    'Negative wrapped' => [v::nullOr(v::not(v::alpha())), 'alpha'],
    'Negative nullined' => [v::not(v::nullOr(v::alpha())), null],
    'Negative nullined, wrapped name' => [v::not(v::nullOr(v::alpha()->setName('Wrapped'))), null],
    'Negative nullined, wrapper name' => [v::not(v::nullOr(v::alpha())->setName('Wrapper')), null],
    'Negative nullined, not name' => [v::not(v::nullOr(v::alpha()))->setName('Not'), null],
    'With template' => [v::nullOr(v::alpha()), 123, 'Nine nimble numismatists near Naples'],
    'With array template' => [v::nullOr(v::alpha()), 123, ['nullOrAlpha' => 'Next to nifty null notations']],
]);
?>
--EXPECT--
Default
⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be null
- 1234 must contain only letters (a-z) or must be null
[
    'nullOrAlpha' => '1234 must contain only letters (a-z) or must be null',
]

Default with many
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
1234 must contain only letters (a-z) or must be null
- All of the required rules must pass for 1234
  - 1234 must contain only letters (a-z) or must be null
  - 1234 must be uppercase or must be null
  - 1234 must start with "a" or must be null
[
    '__root__' => 'All of the required rules must pass for 1234',
    'alpha' => '1234 must contain only letters (a-z) or must be null',
    'uppercase' => '1234 must be uppercase or must be null',
    'startsWith' => '1234 must start with "a" or must be null',
]

Negative with many
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) and must not be null
- These rules must not pass for "alpha"
  - "alpha" must not contain letters (a-z) and must not be null
  - "alpha" must not be lowercase and must not be null
  - "alpha" must not start with "a" and must not be null
[
    '__root__' => 'These rules must not pass for "alpha"',
    'alpha' => '"alpha" must not contain letters (a-z) and must not be null',
    'lowercase' => '"alpha" must not be lowercase and must not be null',
    'startsWith' => '"alpha" must not start with "a" and must not be null',
]

Negative wrapper
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) and must not be null
- "alpha" must not contain letters (a-z) and must not be null
[
    'notNullOrAlpha' => '"alpha" must not contain letters (a-z) and must not be null',
]

Negative wrapped
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
"alpha" must not contain letters (a-z) or must be null
- "alpha" must not contain letters (a-z) or must be null
[
    'nullOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be null',
]

Negative nullined
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The value must not be null
- The value must not be null
[
    'notNullOr' => 'The value must not be null',
]

Negative nullined, wrapped name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped must not be null
- Wrapped must not be null
[
    'notNullOr' => 'Wrapped must not be null',
]

Negative nullined, wrapper name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper must not be null
- Wrapper must not be null
[
    'notNullOr' => 'Wrapper must not be null',
]

Negative nullined, not name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Not must not be null
- Not must not be null
[
    'notNullOr' => 'Not must not be null',
]

With template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Nine nimble numismatists near Naples
- Nine nimble numismatists near Naples
[
    'nullOrAlpha' => 'Nine nimble numismatists near Naples',
]

With array template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Next to nifty null notations
- Next to nifty null notations
[
    'nullOrAlpha' => 'Next to nifty null notations',
]
