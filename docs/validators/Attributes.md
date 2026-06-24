<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Attributes

- `Attributes()`
- `Attributes(TypeResolver $typeResolver)`

Validates the PHP attributes defined in the properties of the input.

Example of object:

```php
use Respect\Validation\Validators as Validator;

#[Validator\AnyOf(
    new Validator\Property('email', new Validator\Not(new Validator\Undef())),
    new Validator\Property('phone', new Validator\Not(new Validator\Undef())),
)]
final class Person
{
    public function __construct(
        #[Validator\Not(new Validator\Undef())]
        public string $name,
        #[Validator\Date('Y-m-d')]
        public string $birthdate,
        #[Validator\Email]
        public ?string $email = null,
        #[Validator\Phone]
        public ?string $phone = null,
    ) {
    }
}
```

Here is how you can validate the attributes of the object:

```php
v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com'));
// Validation passes successfully

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com', '+12024561111'));
// Validation passes successfully

v::attributes()->assert(new Person('', '2020-06-23', 'john.doe@gmail.com', '+12024561111'));
// → `.name` must be defined

v::attributes()->assert(new Person('John Doe', 'not a date', 'john.doe@gmail.com', '+12024561111'));
// → `.birthdate` must be a date in the "2005-12-30" format

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'not an email', '+12024561111'));
// → `.email` must be an email address or must be null

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com', 'not a phone number'));
// → `.phone` must be a phone number or must be null

v::attributes()->assert(new Person('John Doe', '2020-06-23'));
// → - `Person { +$name="John Doe" +$birthdate="2020-06-23" +$email=null +$phone=null }` must pass at least one of the rules
// →   - `.email` must be defined
// →   - `.phone` must be defined

v::attributes()->assert(new Person('', 'not a date', 'not an email', 'not a phone number'));
// → - `Person { +$name="" +$birthdate="not a date" +$email="not an email" +$phone="not a phone number" }` must pass the rules
// →   - `.name` must be defined
// →   - `.birthdate` must be a date in the "2005-12-30" format
// →   - `.email` must be an email address or must be null
// →   - `.phone` must be a phone number or must be null
```

## Caveats

### Empty objects

If the object has no validator attributes on any of its properties or class, the validation will always pass.

### Nullable properties

When a property is nullable (e.g., `?string $email`), `Attributes` wraps the property's validator into [NullOr](NullOr.md), so `null` values are accepted automatically.

### Nested object validation

When a property's type is a class (named, union, or intersection type), `Attributes` recursively validates that object's own properties, so there is no need to explicitly add `#[Attributes]` on the property.

- **Named types** (`NestedAddress $address`): the nested object is validated directly.
- **Union types** (`string|NestedAddress $address`): the nested object is only validated if it passes an `Instance` check first, so string values in the union are safely skipped.
- **Intersection types** (`NestedWithAttributes&Nested $address`): the nested object is validated directly, since it must satisfy all types in the intersection.
- **Untyped properties** (no type declaration, or builtin types like `string`): are never recursively validated.
- **Array properties with `@var` annotations**: `Attributes` automatically validates array elements when the property has a `@var` docblock annotation with type information. See [Array validation from `@var`](#array-validation-from-var) below.
- **Array properties without `@var`**: When an array property has no `@var` annotation (or only `@var array` with no generic type), `Attributes` does not validate individual elements. Use the `#[Each]` attribute on the property (e.g., `#[Each(new Attributes())]`) to validate each element explicitly.

### Array validation from `@var`

When a property is typed as `array` and has a `@var` docblock annotation, `Attributes` automatically derives element validators from the annotation:

| `@var` annotation                            | Generated validator                                                                         |
|:---------------------------------------------|:--------------------------------------------------------------------------------------------|
| `@var array<string>`                         | `Each(new StringType())`                                                                    |
| `@var array<string, int>`                    | `AllOf(EachKey(new StringType()), Each(new IntType()))`                                     |
| `@var array<Address>`                        | `Each(AllOf(Instance(Address), Attributes()))`                                              |
| `@var array<string, Address>`                | `AllOf(EachKey(new StringType()), Each(AllOf(Instance(Address), Attributes())))`            |
| `@var list<Address>`                         | `Each(AllOf(Instance(Address), Attributes()))`                                              |
| `@var array<Address\|string>`                | `Each(AnyOf(AllOf(Instance(Address), Attributes()), StringType()))`                         |
| `@var array<FirstRole&SecondRole>`           | `Each(AllOf(Instance(FirstRole), Instance(SecondRole), Attributes()))`                      |
| `@var array{name: string, age: int}`         | `KeySet(Key('name', StringType()), Key('age', IntType()))`                                  |
| `@var array{name: string, age?: int}`        | `KeySet(Key('name', StringType()), KeyOptional('age', IntType()))`                          |
| `@var array{name: string, address: Address}` | `KeySet(Key('name', StringType()), Key('address', AllOf(Instance(Address), Attributes())))` |
| `@var array<string, array{name: int}>`       | `AllOf(EachKey(new StringType()), Each(KeySet(Key('name', IntType()))))`                    |
| `@var array<Address>\|null`                  | `NullOr(Each(AllOf(Instance(Address), Attributes())))`                                      |
| `@var Address[]`                             | `Each(AllOf(Instance(Address), Attributes()))`                                              |

For array generics with two type parameters (`array<K, V>`), the key type `K` is validated using `EachKey` and the value type `V` is validated using `Each`, both composed via `AllOf`. For single-parameter generics (`array<V>`, `list<V>`), only values are validated since keys are implicit. Union types in element position (e.g., `array<Address|string>`) produce `AnyOf` — each element must pass at least one branch. Intersection types in element position (e.g., `array<FirstRole&SecondRole>`) produce `AllOf` — each element must pass all branches, with `Instance` checks for each class/interface and a single `Attributes()` for recursive validation. Class names in annotations are resolved relative to the property's class namespace.

Array shape keys marked as optional (e.g., `age?` in `array{name: string, age?: int}`) use `KeyOptional` so that missing optional keys are accepted — the key itself may be absent, but if present, its value must match the declared type.

Here is an example of array validation from `@var` annotations:

```php
use Respect\Validation\Validators as Validator;

final class Address
{
    public function __construct(
        #[Validator\Not(new Validator\Undef())]
        public string $street,
        #[Validator\Not(new Validator\Undef())]
        public string $city,
        public ?string $country = null,
    ) {
    }
}

final class Company
{
    /**
     * @var array<string>
     */
    public array $tags = [];

    /**
     * @var array<string, int>
     */
    public array $scores = [];

    /**
     * @var array<Address>
     */
    public array $offices = [];

    /**
     * @var array<Address|string>
     */
    public array $contacts = [];

    /**
     * @var array{name: string, founded?: int}
     */
    public array $info = [];
}
```

Validating the company with correct data:

```php
$company = new Company();
$company->tags = ['tech', 'startup'];
$company->scores = ['a' => 1, 'b' => 2];
$company->offices = [new Address('123 Main St', 'Springfield')];
$company->contacts = ['hello@example.com', new Address('456 Oak Ave', 'Shelbyville')];
$company->info = ['name' => 'Acme Corp'];
v::attributes()->assert($company);
// Validation passes successfully
```

```php
$company = new Company();
$company->tags = ['tech', 'startup'];
$company->scores = ['a' => 1, 'b' => 2];
$company->offices = [new Address('123 Main St', 'Springfield')];
$company->contacts = ['hello@example.com', new Address('456 Oak Ave', 'Shelbyville')];
$company->info = ['name' => 'Acme Corp', 'founded' => 1998];
v::attributes()->assert($company);
// Validation passes successfully
```

Validating the company with incorrect data:

```php
$company = new Company();
$company->tags = ['tech', 123];
$company->scores = ['a' => 1];
$company->contacts = ['hello@example.com'];
$company->info = ['name' => 'Acme'];
v::attributes()->assert($company);
// → `.tags.1` must be a string
```

```php
$company = new Company();
$company->tags = ['tech'];
$company->scores = ['a' => 1, 'b' => 'not an int'];
$company->contacts = ['hello@example.com'];
$company->info = ['name' => 'Acme'];
v::attributes()->assert($company);
// → `.scores.b` must be an integer
```

```php
$company = new Company();
$company->tags = ['tech'];
$company->scores = [0 => 1, 1 => 2];
$company->contacts = ['hello@example.com'];
$company->info = ['name' => 'Acme'];
v::attributes()->assert($company);
// → - Each key in `.scores` must be valid
// →   - Key `.scores.0` must be a string
// →   - Key `.scores.1` must be a string
```

```php
$company = new Company();
$company->tags = ['tech'];
$company->scores = ['a' => 1];
$company->offices = [new Address('', 'not a city')];
$company->contacts = ['hello@example.com'];
$company->info = ['name' => 'Acme'];
v::attributes()->assert($company);
// → `.offices.0.street` must be defined
```

```php
$company = new Company();
$company->tags = ['tech'];
$company->scores = ['a' => 1];
$company->contacts = ['hello@example.com'];
$company->info = ['name' => 42];
v::attributes()->assert($company);
// → `.info.name` must be a string
```

```php
$company = new Company();
$company->tags = ['tech'];
$company->scores = ['a' => 1];
$company->contacts = ['hello@example.com'];
$company->info = ['name' => 'Acme', 'founded' => 'not a year'];
v::attributes()->assert($company);
// → `.info.founded` must be an integer
```

```php
$company = new Company();
$company->tags = ['tech'];
$company->scores = ['a' => 1];
$company->contacts = [123];
$company->info = ['name' => 'Acme'];
v::attributes()->assert($company);
// → - `.contacts.0` must pass at least one of the rules
// →   - `.contacts.0` must pass all the rules
// →     - `.contacts.0` must be an instance of `Address`
// →     - `.contacts.0` must be an object
// →   - `.contacts.0` must be a string
```

Intersection types require each element to satisfy all branches simultaneously. For `@var array<Countable&Traversable>`, every element must be an instance of both `Countable` and `Traversable`. An `ArrayObject` satisfies this (it implements both interfaces), but a plain `ArrayIterator` that only implements `Countable` would fail the `Traversable` check.

### Circular references

When a nested object graph contains a cycle (e.g., `$a->next = $b`, `$b->next = $a`), `Attributes` detects the revisit and fails with the `TEMPLATE_CIRCULAR_REFERENCE` template. This prevents infinite recursion and stack overflow.

Note that circular reference detection only works for direct object references. If a cycle passes through an array (e.g., `$a->items = [$b]`, `$b->parent = $a`), `Attributes` cannot track the reference and the validation will recurse infinitely, causing a stack overflow.

## Templates

### `Attributes::TEMPLATE_CIRCULAR_REFERENCE`

|       Mode | Template                                          |
| ---------: | :------------------------------------------------ |
|  `default` | {{subject}} must not contain a circular reference |
| `inverted` | {{subject}} must contain a circular reference     |

## Categorization

- Objects
- Structures

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Named](Named.md)
- [NullOr](NullOr.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [Templated](Templated.md)
