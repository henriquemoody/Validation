<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', expectFullMessage(
    fn() => Validator::stringType()->lengthBetween(2, 15)->assert(0),
    <<<'FULL_MESSAGE'
    - 0 must pass all the rules
      - 0 must be a string
      - 0 must be a countable value or a string
    FULL_MESSAGE,
));
