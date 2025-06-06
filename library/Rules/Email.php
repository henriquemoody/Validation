<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function class_exists;
use function filter_var;
use function func_num_args;
use function is_string;

use const FILTER_VALIDATE_EMAIL;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid email address',
    '{{name}} must not be an email address',
)]
final class Email extends Simple
{
    private readonly ?EmailValidator $validator;

    public function __construct(?EmailValidator $validator = null)
    {
        if ($validator === null && func_num_args() === 0 && class_exists(EmailValidator::class)) {
            $validator = new EmailValidator();
        }
        $this->validator = $validator;
    }

    public function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if ($this->validator !== null) {
            return $this->validator->isValid($input, new RFCValidation());
        }

        return (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}
