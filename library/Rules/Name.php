<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Spoofchecker;
use function is_scalar;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Name extends AbstractRule
{
    /**
     * @var string|null
     */
    private $locale;

    /**
     * Initializes the rule.
     *
     * @param string $locale
     */
    public function __construct(string $locale = null)
    {
        $this->locale = $locale;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $spoofchecker = new Spoofchecker();
        $spoofchecker->setChecks(Spoofchecker::SINGLE_SCRIPT | Spoofchecker::INVISIBLE);

        if (null !== $this->locale) {
            $spoofchecker->setAllowedLocales($this->locale);
        }

        return false === $spoofchecker->isSuspicious($input);
    }
}
