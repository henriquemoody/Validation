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
use Respect\Validation\Helpers\InMemoryCache;
use Respect\Validation\Test\Stubs\ImplementsBothRoles;
use Respect\Validation\Test\Stubs\ImplementsFirstRoleOnly;
use Respect\Validation\Test\Stubs\NestedAddress;
use Respect\Validation\Test\Stubs\WithAllUnresolvedIntersectionProperty;
use Respect\Validation\Test\Stubs\WithAllUnresolvedUnionProperty;
use Respect\Validation\Test\Stubs\WithArrayGenericThreeArgsProperty;
use Respect\Validation\Test\Stubs\WithArrayGenericUnresolvableInnerProperty;
use Respect\Validation\Test\Stubs\WithArrayGenericUnresolvableKeyProperty;
use Respect\Validation\Test\Stubs\WithArrayGenericUnresolvableValueProperty;
use Respect\Validation\Test\Stubs\WithArrayIntersectionProperty;
use Respect\Validation\Test\Stubs\WithArrayObjectProperty;
use Respect\Validation\Test\Stubs\WithArrayShapeProperty;
use Respect\Validation\Test\Stubs\WithArrayStringProperty;
use Respect\Validation\Test\Stubs\WithArrayUnresolvableInnerProperty;
use Respect\Validation\Test\Stubs\WithArrayUnionProperty;
use Respect\Validation\Test\Stubs\WithBoolProperty;
use Respect\Validation\Test\Stubs\WithClassAndScalarsIntersectionProperty;
use Respect\Validation\Test\Stubs\WithClassAndUnresolvedIntersectionProperty;
use Respect\Validation\Test\Stubs\WithFqnClassProperty;
use Respect\Validation\Test\Stubs\WithFloatProperty;
use Respect\Validation\Test\Stubs\WithGlobalClassProperty;
use Respect\Validation\Test\Stubs\WithIntFloatUnionProperty;
use Respect\Validation\Test\Stubs\WithIntKeyGenericProperty;
use Respect\Validation\Test\Stubs\WithListObjectProperty;
use Respect\Validation\Test\Stubs\WithListUnresolvableInnerProperty;
use Respect\Validation\Test\Stubs\WithNestedGenericShapeProperty;
use Respect\Validation\Test\Stubs\WithNonArrayGenericProperty;
use Respect\Validation\Test\Stubs\WithNonExistentClassProperty;
use Respect\Validation\Test\Stubs\WithNullableStringProperty;
use Respect\Validation\Test\Stubs\WithNullableUnionStringProperty;
use Respect\Validation\Test\Stubs\WithNullableUnresolvableInnerProperty;
use Respect\Validation\Test\Stubs\WithShapeClassValueProperty;
use Respect\Validation\Test\Stubs\WithShapeIntKeyProperty;
use Respect\Validation\Test\Stubs\WithShapeOptionalKeyProperty;
use Respect\Validation\Test\Stubs\WithShapePositionalItemsProperty;
use Respect\Validation\Test\Stubs\WithShapeStringKeyProperty;
use Respect\Validation\Test\Stubs\WithShapeUnresolvableValueProperty;
use Respect\Validation\Test\Stubs\WithShortArrayStringProperty;
use Respect\Validation\Test\Stubs\WithStringUnresolvedUnionProperty;
use Respect\Validation\Test\Stubs\WithThisTypeProperty;
use Respect\Validation\Test\Stubs\WithTwoArgGenericIntProperty;
use Respect\Validation\Test\Stubs\WithTwoArgGenericObjectProperty;
use Respect\Validation\Test\Stubs\WithVarWithoutTypeProperty;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validators\AnyOf;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\BoolType;
use Respect\Validation\Validators\Each;
use Respect\Validation\Validators\EachKey;
use Respect\Validation\Validators\FloatType;
use Respect\Validation\Validators\Instance;
use Respect\Validation\Validators\KeySet;
use Respect\Validation\Validators\NullOr;
use Respect\Validation\Validators\StringType;
use stdClass;

#[Group(' rule')]
#[CoversClass(DocblockPropertyResolver::class)]
#[CoversClass(Attributes::class)]
final class DocblockPropertyResolverTest extends TestCase
{
    private DocblockPropertyResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new DocblockPropertyResolver(new InMemoryCache());
    }

    #[Test]
    public function shouldResolveArrayStringDocblock(): void
    {
        $property = new ReflectionProperty(WithArrayStringProperty::class, 'names');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    #[Test]
    public function shouldResolveArrayObjectDocblock(): void
    {
        $property = new ReflectionProperty(WithArrayObjectProperty::class, 'addresses');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    #[Test]
    public function shouldResolveArrayShapeDocblock(): void
    {
        $property = new ReflectionProperty(WithArrayShapeProperty::class, 'person');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(KeySet::class, $validators[0]);
    }

    #[Test]
    public function shouldResolveListObjectDocblock(): void
    {
        $property = new ReflectionProperty(WithListObjectProperty::class, 'addresses');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    #[Test]
    public function shouldReturnEmptyArrayForPropertyWithoutDocblock(): void
    {
        // NestedAddress has no @var array annotations on its properties
        $property = new ReflectionProperty(NestedAddress::class, 'street');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    #[Test]
    public function shouldValidateArrayOfStrings(): void
    {
        $input = new WithArrayStringProperty();
        $input->names = ['John', 'Jane', 'Doe'];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayOfNonStrings(): void
    {
        $input = new WithArrayStringProperty();
        $input->names = ['John', 123, 'Doe']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateArrayOfObjects(): void
    {
        $input = new WithArrayObjectProperty();
        $input->addresses = [
            new NestedAddress('123 Main St', 'Springfield'),
            new NestedAddress('456 Oak Ave', 'Shelbyville'),
        ];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayOfObjectsWithInvalidProperties(): void
    {
        $input = new WithArrayObjectProperty();
        $input->addresses = [
            new NestedAddress('123 Main St', 'Springfield'),
            new NestedAddress('', 'not a city'),
        ];

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayOfObjectsWithNonMatchingElement(): void
    {
        $input = new WithArrayObjectProperty();
        $input->addresses = [ // @phpstan-ignore assign.propertyType
            new NestedAddress('123 Main St', 'Springfield'),
            new stdClass(),
        ];

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateArrayShape(): void
    {
        $input = new WithArrayShapeProperty();
        $input->person = ['name' => 'John', 'age' => 30];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayShapeWithWrongTypes(): void
    {
        $input = new WithArrayShapeProperty();
        $input->person = ['name' => 123, 'age' => 'not an int']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateListOfObjects(): void
    {
        $input = new WithListObjectProperty();
        $input->addresses = [
            new NestedAddress('123 Main St', 'Springfield'),
        ];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateListOfObjectsWithInvalidProperties(): void
    {
        $input = new WithListObjectProperty();
        $input->addresses = [
            new NestedAddress('', 'not a city'),
        ];

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveTwoArgGenericIntDocblock(): void
    {
        $property = new ReflectionProperty(WithTwoArgGenericIntProperty::class, 'items');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(EachKey::class, $validators[0]);
        self::assertInstanceOf(Each::class, $validators[1]);
    }

    #[Test]
    public function shouldValidateTwoArgGenericInt(): void
    {
        $input = new WithTwoArgGenericIntProperty();
        $input->items = ['a' => 1, 'b' => 2];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateTwoArgGenericIntWithWrongValueTypes(): void
    {
        $input = new WithTwoArgGenericIntProperty();
        $input->items = ['a' => 'not an int']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveTwoArgGenericObjectDocblock(): void
    {
        $property = new ReflectionProperty(WithTwoArgGenericObjectProperty::class, 'addresses');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(EachKey::class, $validators[0]);
        self::assertInstanceOf(Each::class, $validators[1]);
    }

    #[Test]
    public function shouldValidateTwoArgGenericObject(): void
    {
        $input = new WithTwoArgGenericObjectProperty();
        $input->addresses = [
            'home' => new NestedAddress('123 Main St', 'Springfield'),
            'work' => new NestedAddress('456 Oak Ave', 'Shelbyville'),
        ];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateTwoArgGenericObjectWithInvalidProperties(): void
    {
        $input = new WithTwoArgGenericObjectProperty();
        $input->addresses = [
            'home' => new NestedAddress('', 'not a city'),
        ];

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveShapeClassValueDocblock(): void
    {
        $property = new ReflectionProperty(WithShapeClassValueProperty::class, 'data');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(KeySet::class, $validators[0]);
    }

    #[Test]
    public function shouldValidateShapeClassValue(): void
    {
        $input = new WithShapeClassValueProperty();
        $input->data = ['name' => 'John', 'address' => new NestedAddress('123 Main St', 'Springfield')];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateShapeClassValueWithInvalidObject(): void
    {
        $input = new WithShapeClassValueProperty();
        $input->data = ['name' => 'John', 'address' => new NestedAddress('', 'not a city')];

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveShapeOptionalKeyDocblock(): void
    {
        $property = new ReflectionProperty(WithShapeOptionalKeyProperty::class, 'person');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(KeySet::class, $validators[0]);
    }

    #[Test]
    public function shouldValidateShapeOptionalKeyWithAllKeys(): void
    {
        $input = new WithShapeOptionalKeyProperty();
        $input->person = ['name' => 'John', 'age' => 30];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateShapeOptionalKeyWithoutOptionalKey(): void
    {
        $input = new WithShapeOptionalKeyProperty();
        $input->person = ['name' => 'Jane'];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateShapeOptionalKeyWithWrongTypeInOptionalKey(): void
    {
        $input = new WithShapeOptionalKeyProperty();
        $input->person = ['name' => 'Bob', 'age' => 'not an int']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveNestedGenericShapeDocblock(): void
    {
        $property = new ReflectionProperty(WithNestedGenericShapeProperty::class, 'items');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(EachKey::class, $validators[0]);
        self::assertInstanceOf(Each::class, $validators[1]);
    }

    #[Test]
    public function shouldValidateNestedGenericShape(): void
    {
        $input = new WithNestedGenericShapeProperty();
        $input->items = ['a' => ['name' => 1], 'b' => ['name' => 2]];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateNestedGenericShapeWithWrongValueTypes(): void
    {
        $input = new WithNestedGenericShapeProperty();
        $input->items = ['a' => ['name' => 'not an int']]; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveIntKeyGenericDocblock(): void
    {
        $property = new ReflectionProperty(WithIntKeyGenericProperty::class, 'items');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(EachKey::class, $validators[0]);
        self::assertInstanceOf(Each::class, $validators[1]);
    }

    #[Test]
    public function shouldValidateIntKeyGenericWithValidKeys(): void
    {
        $input = new WithIntKeyGenericProperty();
        $input->items = [0 => 'a', 1 => 'b'];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateIntKeyGenericWithStringKeys(): void
    {
        $input = new WithIntKeyGenericProperty();
        $input->items = ['x' => 'a', 'y' => 'b']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateTwoArgGenericWithIntKeysWhenStringExpected(): void
    {
        $input = new WithTwoArgGenericIntProperty();
        $input->items = [0 => 1, 1 => 2]; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveArrayUnionDocblock(): void
    {
        $property = new ReflectionProperty(WithArrayUnionProperty::class, 'items');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    #[Test]
    public function shouldValidateArrayOfUnionWithValidStrings(): void
    {
        $input = new WithArrayUnionProperty();
        $input->items = ['hello', 'world'];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateArrayOfUnionWithValidObjects(): void
    {
        $input = new WithArrayUnionProperty();
        $input->items = [new NestedAddress('123 Main St', 'Springfield')];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateArrayOfUnionWithMixedTypes(): void
    {
        $input = new WithArrayUnionProperty();
        $input->items = ['hello', new NestedAddress('123 Main St', 'Springfield')];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayOfUnionWithInvalidObject(): void
    {
        $input = new WithArrayUnionProperty();
        $input->items = [new NestedAddress('', 'not a city')];

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayOfUnionWithInvalidType(): void
    {
        $input = new WithArrayUnionProperty();
        $input->items = [123]; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldResolveArrayIntersectionDocblock(): void
    {
        $property = new ReflectionProperty(WithArrayIntersectionProperty::class, 'items');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    #[Test]
    public function shouldValidateArrayOfIntersectionWithValidObject(): void
    {
        $input = new WithArrayIntersectionProperty();
        $input->items = [new ImplementsBothRoles('test')];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayOfIntersectionWithPartialMatch(): void
    {
        $input = new WithArrayIntersectionProperty();
        $input->items = [new ImplementsFirstRoleOnly('test')]; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    // --- cache ---------------------------------------------------------------

    #[Test]
    public function shouldReturnCachedTypeNodeOnSecondCall(): void
    {
        $property = new ReflectionProperty(WithArrayStringProperty::class, 'names');
        $attributes = new Attributes();

        $first = $this->resolver->resolve($property, $attributes);
        $second = $this->resolver->resolve($property, $attributes);

        // Both calls must return validators (the second one is served from cache).
        self::assertCount(1, $first);
        self::assertCount(1, $second);
        self::assertInstanceOf(Each::class, $first[0]);
        self::assertInstanceOf(Each::class, $second[0]);
    }

    // --- parseVarType: empty @var / @var without type ------------------------

    #[Test]
    public function shouldReturnEmptyArrayWhenVarTagHasNoType(): void
    {
        $property = new ReflectionProperty(WithVarWithoutTypeProperty::class, 'value');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveTypeNode: ArrayTypeNode (short array syntax) -----------------

    #[Test]
    public function shouldResolveShortArrayStringDocblock(): void
    {
        $property = new ReflectionProperty(WithShortArrayStringProperty::class, 'names');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    #[Test]
    public function shouldReturnEmptyArrayForShortArrayWithUnresolvableInner(): void
    {
        $property = new ReflectionProperty(WithArrayUnresolvableInnerProperty::class, 'items');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveTypeNode: NullableTypeNode -----------------------------------

    #[Test]
    public function shouldResolveNullableStringDocblock(): void
    {
        $property = new ReflectionProperty(WithNullableStringProperty::class, 'name');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(NullOr::class, $validators[0]);
    }

    #[Test]
    public function shouldReturnEmptyArrayForNullableWithUnresolvableInner(): void
    {
        $property = new ReflectionProperty(WithNullableUnresolvableInnerProperty::class, 'value');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveTypeNode: unknown TypeNode subclass (ThisTypeNode) ------------

    #[Test]
    public function shouldReturnEmptyArrayForUnsupportedTypeNode(): void
    {
        $property = new ReflectionProperty(WithThisTypeProperty::class, 'value');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveGenericType: non-array/list base ----------------------------

    #[Test]
    public function shouldReturnEmptyArrayForNonArrayGenericBase(): void
    {
        $property = new ReflectionProperty(WithNonArrayGenericProperty::class, 'items');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveGenericType: list with unresolvable inner -------------------

    #[Test]
    public function shouldReturnEmptyArrayForListWithUnresolvableInner(): void
    {
        $property = new ReflectionProperty(WithListUnresolvableInnerProperty::class, 'items');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveArrayGeneric: 1-arg with unresolvable inner -----------------

    #[Test]
    public function shouldReturnEmptyArrayForArrayGenericWithUnresolvableInner(): void
    {
        $property = new ReflectionProperty(WithArrayGenericUnresolvableInnerProperty::class, 'items');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveArrayGeneric: 2-arg with unresolvable value -----------------

    #[Test]
    public function shouldReturnEmptyArrayForArrayGenericWithUnresolvableValue(): void
    {
        $property = new ReflectionProperty(WithArrayGenericUnresolvableValueProperty::class, 'items');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveArrayGeneric: 2-arg with unresolvable key (Each only) --------

    #[Test]
    public function shouldResolveEachOnlyWhenKeyIsUnresolvable(): void
    {
        $property = new ReflectionProperty(WithArrayGenericUnresolvableKeyProperty::class, 'items');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(Each::class, $validators[0]);
    }

    // --- resolveArrayGeneric: 3-arg unsupported -----------------------------

    #[Test]
    public function shouldReturnEmptyArrayForArrayGenericWithThreeArgs(): void
    {
        $property = new ReflectionProperty(WithArrayGenericThreeArgsProperty::class, 'items');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveArrayShape: unresolvable item value -------------------------

    #[Test]
    public function shouldReturnEmptyArrayForShapeWithUnresolvableValue(): void
    {
        $property = new ReflectionProperty(WithShapeUnresolvableValueProperty::class, 'data');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveArrayShape: positional items (null keyName) -----------------

    #[Test]
    public function shouldReturnEmptyArrayForShapeWithPositionalItems(): void
    {
        $property = new ReflectionProperty(WithShapePositionalItemsProperty::class, 'pair');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveArrayShape: ConstExprStringNode key -------------------------

    #[Test]
    public function shouldResolveShapeWithQuotedStringKey(): void
    {
        $property = new ReflectionProperty(WithShapeStringKeyProperty::class, 'person');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(KeySet::class, $validators[0]);
    }

    // --- resolveArrayShape: ConstExprIntegerNode key ------------------------

    #[Test]
    public function shouldResolveShapeWithIntegerKey(): void
    {
        $property = new ReflectionProperty(WithShapeIntKeyProperty::class, 'pair');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(KeySet::class, $validators[0]);
    }

    // --- resolveUnionType: null + single resolvable -> NullOr ---------------

    #[Test]
    public function shouldResolveNullableUnionStringDocblock(): void
    {
        $property = new ReflectionProperty(WithNullableUnionStringProperty::class, 'name');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(NullOr::class, $validators[0]);
    }

    // --- resolveUnionType: single resolvable, no null -> [validator] --------

    #[Test]
    public function shouldResolveUnionWithSingleResolvableMember(): void
    {
        $property = new ReflectionProperty(WithStringUnresolvedUnionProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        // The unresolved member is skipped; one validator remains, no null.
        self::assertCount(1, $validators);
        self::assertInstanceOf(StringType::class, $validators[0]);
    }

    // --- resolveUnionType: two resolvable members, no null -> AnyOf --------

    #[Test]
    public function shouldResolveUnionWithMultipleResolvableMembers(): void
    {
        $property = new ReflectionProperty(WithIntFloatUnionProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(AnyOf::class, $validators[0]);
    }

    // --- resolveUnionType: all members unresolved -> [] ---------------------

    #[Test]
    public function shouldReturnEmptyArrayForUnionWithAllMembersUnresolved(): void
    {
        $property = new ReflectionProperty(WithAllUnresolvedUnionProperty::class, 'value');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveIntersectionType: class + scalars ---------------------------

    #[Test]
    public function shouldResolveIntersectionWithClassAndScalars(): void
    {
        $property = new ReflectionProperty(WithClassAndScalarsIntersectionProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        // The class branch is detected: scalar validators are filtered out and
        // the Attributes validator is appended, so the result is non-empty.
        self::assertNotEmpty($validators);
        self::assertContains($attributes, $validators);
    }

    // --- resolveIntersectionType: class + unresolved ------------------------

    #[Test]
    public function shouldResolveIntersectionWithClassAndUnresolvedMember(): void
    {
        $property = new ReflectionProperty(WithClassAndUnresolvedIntersectionProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        // The unresolved member is skipped; the resolved class branch is kept.
        self::assertNotEmpty($validators);
    }

    // --- resolveIntersectionType: all unresolved -> [] ---------------------

    #[Test]
    public function shouldReturnEmptyArrayForIntersectionWithAllMembersUnresolved(): void
    {
        $property = new ReflectionProperty(WithAllUnresolvedIntersectionProperty::class, 'value');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveIdentifier: float / bool ------------------------------------

    #[Test]
    public function shouldResolveFloatIdentifier(): void
    {
        $property = new ReflectionProperty(WithFloatProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(FloatType::class, $validators[0]);
    }

    #[Test]
    public function shouldResolveBoolIdentifier(): void
    {
        $property = new ReflectionProperty(WithBoolProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $validators);
        self::assertInstanceOf(BoolType::class, $validators[0]);
    }

    // --- resolveClassIdentifier: non-existent class -> [] ------------------

    #[Test]
    public function shouldReturnEmptyArrayForNonExistentClassIdentifier(): void
    {
        $property = new ReflectionProperty(WithNonExistentClassProperty::class, 'value');
        $attributes = new Attributes();

        self::assertSame([], $this->resolver->resolve($property, $attributes));
    }

    // --- resolveClassName: FQN (\-prefixed) via ltrim ------------------------

    #[Test]
    public function shouldResolveFullyQualifiedClassName(): void
    {
        $property = new ReflectionProperty(WithFqnClassProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(Instance::class, $validators[0]);
        self::assertInstanceOf(Attributes::class, $validators[1]);
    }

    // --- resolveClassName: namespace lookup fails, falls back to bare name ---

    #[Test]
    public function shouldResolveGlobalClassNameViaNamespaceFallback(): void
    {
        $property = new ReflectionProperty(WithGlobalClassProperty::class, 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(Instance::class, $validators[0]);
        self::assertInstanceOf(Attributes::class, $validators[1]);
    }

    // --- getNamespace: class with no namespace returns '' -------------------

    #[Test]
    public function shouldResolveClassNameForGlobalNamespaceClass(): void
    {
        require_once dirname(__DIR__, 4) . '/tests/src/Stubs/GlobalStubWithDocblock.php';

        $property = new ReflectionProperty('GlobalStubWithDocblock', 'value');
        $attributes = new Attributes();
        $validators = $this->resolver->resolve($property, $attributes);

        self::assertCount(2, $validators);
        self::assertInstanceOf(Instance::class, $validators[0]);
        self::assertInstanceOf(Attributes::class, $validators[1]);
    }

    // --- behavioral checks for the new array-based branches ------------------

    #[Test]
    public function shouldValidateShortArrayOfStrings(): void
    {
        $input = new WithShortArrayStringProperty();
        $input->names = ['John', 'Jane'];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateShortArrayOfNonStrings(): void
    {
        $input = new WithShortArrayStringProperty();
        $input->names = ['John', 123]; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateArrayGenericWhenKeyIsUnresolvable(): void
    {
        $input = new WithArrayGenericUnresolvableKeyProperty();
        $input->items = ['x' => 'a', 'y' => 'b'];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateArrayGenericWhenKeyIsUnresolvableWithBadValues(): void
    {
        $input = new WithArrayGenericUnresolvableKeyProperty();
        $input->items = ['x' => 123]; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateShapeWithQuotedStringKey(): void
    {
        $input = new WithShapeStringKeyProperty();
        $input->person = ['first-name' => 'John', 'age' => 30];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateShapeWithQuotedStringKeyWithWrongTypes(): void
    {
        $input = new WithShapeStringKeyProperty();
        $input->person = ['first-name' => 123, 'age' => 'not an int']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateShapeWithIntegerKey(): void
    {
        $input = new WithShapeIntKeyProperty();
        $input->pair = ['a', 2];

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateShapeWithIntegerKeyWithWrongTypes(): void
    {
        $input = new WithShapeIntKeyProperty();
        $input->pair = [0 => 1, 1 => 'not an int']; // @phpstan-ignore assign.propertyType

        self::assertInvalidInput(new Attributes(), $input);
    }
}
