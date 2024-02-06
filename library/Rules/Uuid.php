<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Template;

use function is_string;
use function preg_match;
use function sprintf;

#[Template(
    '{{name}} must be a valid UUID',
    '{{name}} must not be a valid UUID',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be a valid UUID version {{version}}',
    '{{name}} must not be a valid UUID version {{version}}',
    self::TEMPLATE_VERSION,
)]
final class Uuid extends AbstractRule
{
    public const TEMPLATE_VERSION = 'version';

    private const PATTERN_FORMAT = '/^[0-9a-f]{8}-[0-9a-f]{4}-%s[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    public function __construct(
        private readonly ?int $version = null
    ) {
        if ($version !== null && !$this->isSupportedVersion($version)) {
            throw new ComponentException(sprintf('Only versions 1, 3, 4, and 5 are supported: %d given', $version));
        }
    }

    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match($this->getPattern(), $input) > 0;
    }

    public function getTemplate(mixed $input): string
    {
        return $this->template ?? ($this->version ? self::TEMPLATE_VERSION : self::TEMPLATE_STANDARD);
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['version' => $this->version];
    }

    private function isSupportedVersion(int $version): bool
    {
        return $version >= 1 && $version <= 5 && $version !== 2;
    }

    private function getPattern(): string
    {
        if ($this->version !== null) {
            return sprintf(self::PATTERN_FORMAT, $this->version);
        }

        return sprintf(self::PATTERN_FORMAT, '[13-5]');
    }
}
