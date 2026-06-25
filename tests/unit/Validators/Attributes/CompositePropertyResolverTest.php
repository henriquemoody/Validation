<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionProperty;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\IntType;
use Respect\Validation\Validators\StringType;
use RuntimeException;

#[Group(' rule')]
#[CoversClass(CompositePropertyResolver::class)]
final class CompositePropertyResolverTest extends TestCase
{
    private ReflectionProperty $property;

    private Attributes $attributes;

    protected function setUp(): void
    {
        $object = new class {
            public mixed $value;
        };
        $this->property = new ReflectionProperty($object::class, 'value');
        $this->attributes = new Attributes();
    }

    #[Test]
    public function shouldReturnEmptyWhenNoResolversProvided(): void
    {
        $resolver = new CompositePropertyResolver();

        $result = $resolver->resolve($this->property, $this->attributes);

        self::assertSame([], $result);
    }

    #[Test]
    public function shouldReturnEmptyWhenAllResolversReturnEmpty(): void
    {
        $emptyResolver = new class implements PropertyResolver {
            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                return [];
            }
        };

        $resolver = new CompositePropertyResolver($emptyResolver, $emptyResolver);

        $result = $resolver->resolve($this->property, $this->attributes);

        self::assertSame([], $result);
    }

    #[Test]
    public function shouldConcatenateNonTerminalResultsFromMultipleResolvers(): void
    {
        $first = new class implements PropertyResolver {
            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                return [new StringType()];
            }
        };

        $second = new class implements PropertyResolver {
            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                return [new IntType()];
            }
        };

        $resolver = new CompositePropertyResolver($first, $second);

        $result = $resolver->resolve($this->property, $this->attributes);

        self::assertCount(2, $result);
        self::assertInstanceOf(StringType::class, $result[0]);
        self::assertInstanceOf(IntType::class, $result[1]);
    }

    #[Test]
    public function shouldShortCircuitWhenFirstResolverReturnsAttributes(): void
    {
        $attributes = $this->attributes;

        $terminal = new class ($attributes) implements PropertyResolver {
            public function __construct(private Attributes $attributes)
            {
            }

            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                return [$this->attributes];
            }
        };

        $spy = new class implements PropertyResolver {
            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                throw new RuntimeException('should not be called');
            }
        };

        $resolver = new CompositePropertyResolver($terminal, $spy);

        $result = $resolver->resolve($this->property, $attributes);

        self::assertSame([$attributes], $result);
    }

    #[Test]
    public function shouldShortCircuitWhenMiddleResolverReturnsAttributes(): void
    {
        $attributes = $this->attributes;

        $first = new class implements PropertyResolver {
            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                return [new StringType()];
            }
        };

        $middle = new class ($attributes) implements PropertyResolver {
            public function __construct(private Attributes $attributes)
            {
            }

            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                return [$this->attributes];
            }
        };

        $spy = new class implements PropertyResolver {
            public function resolve(ReflectionProperty $property, Attributes $attributes): array
            {
                throw new RuntimeException('should not be called');
            }
        };

        $resolver = new CompositePropertyResolver($first, $middle, $spy);

        $result = $resolver->resolve($this->property, $attributes);

        self::assertCount(2, $result);
        self::assertInstanceOf(StringType::class, $result[0]);
        self::assertSame($attributes, $result[1]);
    }
}
