--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::create()
        ->key('first', v::alwaysInvalid()->alwaysInvalid())
        ->key('second', v::alwaysInvalid())
        ->key('third', v::alwaysInvalid()->alwaysInvalid())
        ->assert([
            'first' => 'deer',
            'second' => 'moose',
            'third' => 'cat',
        ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage();
}
--EXPECT--
- All of the required rules must pass for `{ "first": "deer", "second": "moose", "third": "cat" }`
  - All of the required rules must pass for first
    - first is always invalid
    - first is always invalid
  - second is always invalid
  - All of the required rules must pass for third
    - third is always invalid
    - third is always invalid
