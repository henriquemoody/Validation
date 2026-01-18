<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use function count;
use function lcfirst;
use function strrchr;
use function substr;
use function ucfirst;

final readonly class Id
{
    public function __construct(
        public string $value,
    ) {
    }

    public static function fromValidator(Validator $validator): self
    {
        if ($validator instanceof ValidatorBuilder && count($validator->getValidators()) === 1) {
            return self::fromValidator($validator->getValidators()[0]);
        }

        return new self(lcfirst(substr((string) strrchr($validator::class, '\\'), 1)));
    }

    public function withPrefix(string $prefix): self
    {
        return new self($prefix . ucfirst($this->value));
    }
}
