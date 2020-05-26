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

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Svalbard and Jan Mayen subdivision code.
 *
 * ISO 3166-1 alpha-2: SJ
 *
 * @see http://www.geonames.org/SJ/administrative-division-svalbard-and-jan-mayen.html
 */
class SjSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '21', // Svalbard
        '22', // Jan Mayen
    ];

    public $compareIdentical = true;
}