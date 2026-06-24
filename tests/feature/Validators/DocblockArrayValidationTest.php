<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\ImplementsBothRoles;
use Respect\Validation\Test\Stubs\ImplementsFirstRoleOnly;
use Respect\Validation\Test\Stubs\NestedAddress;
use Respect\Validation\Test\Stubs\WithArrayIntersectionProperty;
use Respect\Validation\Test\Stubs\WithArrayObjectProperty;
use Respect\Validation\Test\Stubs\WithArrayShapeProperty;
use Respect\Validation\Test\Stubs\WithArrayStringProperty;
use Respect\Validation\Test\Stubs\WithArrayUnionProperty;
use Respect\Validation\Test\Stubs\WithIntKeyGenericProperty;
use Respect\Validation\Test\Stubs\WithListObjectProperty;
use Respect\Validation\Test\Stubs\WithNestedGenericShapeProperty;
use Respect\Validation\Test\Stubs\WithNullableArrayOfObjects;
use Respect\Validation\Test\Stubs\WithShapeClassValueProperty;
use Respect\Validation\Test\Stubs\WithShapeOptionalKeyProperty;
use Respect\Validation\Test\Stubs\WithTwoArgGenericIntProperty;
use Respect\Validation\Test\Stubs\WithTwoArgGenericObjectProperty;

test('Array of strings with valid input passes validation', function (): void {
    $input = new WithArrayStringProperty();
    $input->names = ['John', 'Jane', 'Doe'];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array of strings with invalid element type fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayStringProperty {
        $obj = new WithArrayStringProperty();
        $obj->names = ['John', 123, 'Doe']; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.names.1` must be a string')
        ->and($fullMessage)->toBe('- `.names.1` must be a string')
        ->and($messages)->toBe(['`.names.1` must be a string']),
));

test('Array of objects with valid input passes validation', function (): void {
    $input = new WithArrayObjectProperty();
    $input->addresses = [
        new NestedAddress('123 Main St', 'Springfield'),
        new NestedAddress('456 Oak Ave', 'Shelbyville'),
    ];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array of objects with invalid nested object fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayObjectProperty {
        $obj = new WithArrayObjectProperty();
        $obj->addresses = [
            new NestedAddress('123 Main St', 'Springfield'),
            new NestedAddress('', 'not a city'),
        ];

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.addresses.1.street` must be defined')
        ->and($fullMessage)->toBe('- `.addresses.1.street` must be defined')
        ->and($messages)->toBe(['`.addresses.1.street` must be defined']),
));

test('Array of objects with non-matching element fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayObjectProperty {
        $obj = new WithArrayObjectProperty();
        // @phpstan-ignore assign.propertyType
        $obj->addresses = [new NestedAddress('123 Main St', 'Springfield'), new stdClass()];

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe(
            '`.addresses.1` must be an instance of `Respect\Validation\Test\Stubs\NestedAddress`',
        )
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `.addresses.1` must be an instance of `Respect\Validation\Test\Stubs\NestedAddress`
            FULL_MESSAGE),
));

test('Array shape with valid input passes validation', function (): void {
    $input = new WithArrayShapeProperty();
    $input->person = ['name' => 'John', 'age' => 30];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array shape with wrong value types fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayShapeProperty {
        $obj = new WithArrayShapeProperty();
        $obj->person = ['name' => 123, 'age' => 'not an int']; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.person.name` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `.person` validation failed
              - `.person.name` must be a string
              - `.person.age` must be an integer
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`.person` validation failed',
            'name' => '`.person.name` must be a string',
            'age' => '`.person.age` must be an integer',
        ]),
));

test('List of objects with valid input passes validation', function (): void {
    $input = new WithListObjectProperty();
    $input->addresses = [new NestedAddress('123 Main St', 'Springfield')];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('List of objects with invalid nested object fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithListObjectProperty {
        $obj = new WithListObjectProperty();
        $obj->addresses = [new NestedAddress('', 'not a city')];

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.addresses.0.street` must be defined')
        ->and($fullMessage)->toBe('- `.addresses.0.street` must be defined')
        ->and($messages)->toBe(['`.addresses.0.street` must be defined']),
));

test('Nullable array of objects with null value passes validation', function (): void {
    $input = new WithNullableArrayOfObjects();

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Two-arg generic array<string, int> with valid input passes validation', function (): void {
    $input = new WithTwoArgGenericIntProperty();
    $input->items = ['a' => 1, 'b' => 2, 'c' => 3];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Two-arg generic array<string, int> with wrong value type fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithTwoArgGenericIntProperty {
        $obj = new WithTwoArgGenericIntProperty();
        $obj->items = ['a' => 1, 'b' => 'not an int']; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.items.b` must be an integer')
        ->and($fullMessage)->toBe('- `.items.b` must be an integer')
        ->and($messages)->toBe(['items' => '`.items.b` must be an integer']),
));

test('Two-arg generic array<string, Address> with valid input passes validation', function (): void {
    $input = new WithTwoArgGenericObjectProperty();
    $input->addresses = [
        'home' => new NestedAddress('123 Main St', 'Springfield'),
        'work' => new NestedAddress('456 Oak Ave', 'Shelbyville'),
    ];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Two-arg generic array<string, Address> with invalid nested object fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithTwoArgGenericObjectProperty {
        $obj = new WithTwoArgGenericObjectProperty();
        $obj->addresses = [
            'home' => new NestedAddress('', 'not a city'),
        ];

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.addresses.home.street` must be defined')
        ->and($fullMessage)->toBe('- `.addresses.home.street` must be defined')
        ->and($messages)->toBe(['addresses' => '`.addresses.home.street` must be defined']),
));

test('Array shape with class value valid input passes validation', function (): void {
    $input = new WithShapeClassValueProperty();
    $input->data = ['name' => 'John', 'address' => new NestedAddress('123 Main St', 'Springfield')];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array shape with class value invalid object fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithShapeClassValueProperty {
        $obj = new WithShapeClassValueProperty();
        $obj->data = ['name' => 'John', 'address' => new NestedAddress('', 'not a city')];

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.data.address.street` must be defined')
        ->and($fullMessage)->toBe('- `.data.address.street` must be defined')
        ->and($messages)->toBe(['address' => '`.data.address.street` must be defined']),
));

test('Array shape with optional key present passes validation', function (): void {
    $input = new WithShapeOptionalKeyProperty();
    $input->person = ['name' => 'John', 'age' => 30];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array shape with optional key absent passes validation', function (): void {
    $input = new WithShapeOptionalKeyProperty();
    $input->person = ['name' => 'Jane'];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array shape with optional key wrong type fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithShapeOptionalKeyProperty {
        $obj = new WithShapeOptionalKeyProperty();
        $obj->person = ['name' => 'Bob', 'age' => 'not an int']; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.person.age` must be an integer')
        ->and($fullMessage)->toBe('- `.person.age` must be an integer')
        ->and($messages)->toBe(['age' => '`.person.age` must be an integer']),
));

test('Nested generic with shape value valid input passes validation', function (): void {
    $input = new WithNestedGenericShapeProperty();
    $input->items = ['a' => ['name' => 1], 'b' => ['name' => 2]];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Nested generic with shape value wrong type fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithNestedGenericShapeProperty {
        $obj = new WithNestedGenericShapeProperty();
        $obj->items = ['a' => ['name' => 'not an int']]; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.items.a.name` must be an integer')
        ->and($fullMessage)->toBe('- `.items.a.name` must be an integer')
        ->and($messages)->toBe(['items' => '`.items.a.name` must be an integer']),
));

test('Two-arg generic array<string, int> with integer keys fails key validation', catchAll(
    fn() => v::attributes()->assert((function (): WithTwoArgGenericIntProperty {
        $obj = new WithTwoArgGenericIntProperty();
        $obj->items = [0 => 1, 1 => 2]; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.items.0` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Each key in `.items` must be valid
              - Key `.items.0` must be a string
              - Key `.items.1` must be a string
            FULL_MESSAGE)
        ->and($messages)->toBe([
            'items' => [
                '__root__' => 'Each key in `.items` must be valid',
                '0' => 'Key `.items.0` must be a string',
                '1' => 'Key `.items.1` must be a string',
            ],
        ]),
));

test('Two-arg generic array<int, string> with valid keys passes validation', function (): void {
    $input = new WithIntKeyGenericProperty();
    $input->items = [0 => 'a', 1 => 'b', 2 => 'c'];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Two-arg generic array<int, string> with string keys fails key validation', catchAll(
    fn() => v::attributes()->assert((function (): WithIntKeyGenericProperty {
        $obj = new WithIntKeyGenericProperty();
        $obj->items = ['x' => 'a', 'y' => 'b']; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.items.x` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Each key in `.items` must be valid
              - Key `.items.x` must be an integer
              - Key `.items.y` must be an integer
            FULL_MESSAGE)
        ->and($messages)->toBe([
            'items' => [
                '__root__' => 'Each key in `.items` must be valid',
                'x' => 'Key `.items.x` must be an integer',
                'y' => 'Key `.items.y` must be an integer',
            ],
        ]),
));

test('Array of union type with valid strings passes validation', function (): void {
    $input = new WithArrayUnionProperty();
    $input->items = ['hello', 'world'];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array of union type with valid objects passes validation', function (): void {
    $input = new WithArrayUnionProperty();
    $input->items = [new NestedAddress('123 Main St', 'Springfield')];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array of union type with mixed valid types passes validation', function (): void {
    $input = new WithArrayUnionProperty();
    $input->items = ['hello', new NestedAddress('123 Main St', 'Springfield')];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array of union type with invalid object fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayUnionProperty {
        $obj = new WithArrayUnionProperty();
        $obj->items = [new NestedAddress('', 'not a city')];

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.items.0.street` must be defined')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `.items.0` must pass at least one of the rules
              - `.items.0` must pass the rules
                - `.items.0.street` must be defined
              - `.items.0` must be a string
            FULL_MESSAGE),
));

test('Array of union type with invalid type fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayUnionProperty {
        $obj = new WithArrayUnionProperty();
        $obj->items = [123]; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe(
            '`.items.0` must be an instance of `Respect\Validation\Test\Stubs\NestedAddress`',
        )
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `.items.0` must pass at least one of the rules
              - `.items.0` must pass all the rules
                - `.items.0` must be an instance of `Respect\Validation\Test\Stubs\NestedAddress`
                - `.items.0` must be an object
              - `.items.0` must be a string
            FULL_MESSAGE),
));

test('Array of intersection type with valid object passes validation', function (): void {
    $input = new WithArrayIntersectionProperty();
    $input->items = [new ImplementsBothRoles('test')];

    expect(v::attributes()->evaluate($input)->hasPassed)->toBeTrue();
});

test('Array of intersection type with partial match fails validation', catchAll(
    fn() => v::attributes()->assert((function (): WithArrayIntersectionProperty {
        $obj = new WithArrayIntersectionProperty();
        $obj->items = [new ImplementsFirstRoleOnly('test')]; // @phpstan-ignore assign.propertyType

        return $obj;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe(
            '`.items.0` must be an instance of `Respect\Validation\Test\Stubs\SecondRole`',
        )
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `.items.0` must be an instance of `Respect\Validation\Test\Stubs\SecondRole`
            FULL_MESSAGE),
));
