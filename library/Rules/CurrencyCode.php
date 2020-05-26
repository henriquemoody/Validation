<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates currency codes in ISO 4217.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Justin Hook <justinhook88@yahoo.co.uk>
 * @author Tim Strijdhorst <tstrijdhorst@users.noreply.github.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CurrencyCode extends AbstractSearcher
{
    /**
     * @see http://www.currency-iso.org/en/home/tables/table-a1.html
     *
     * {@inheritDoc}
     */
    protected function getDataSource(): array
    {
        return [
        ];
    }
}
