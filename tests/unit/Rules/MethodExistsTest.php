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

use ArrayObject;
use Countable;
use Respect\Validation\Test\RuleTestCase;
use stdClass;
use Traversable;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\MethodExists
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MethodExistsTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new MethodExists('count'), Countable::class],
            [new MethodExists('getArrayCopy'), new ArrayObject()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new MethodExists('whatever'), Traversable::class],
            [new MethodExists('whatever'), new stdClass()],
            [new MethodExists('whatever'), []],
            [new MethodExists('whatever'), true],
            [new MethodExists('whatever'), 123],
            [new MethodExists('whatever'), 1.2],
            [new MethodExists('whatever'), null],
            [new MethodExists('whatever'), ''],
        ];
    }
}
