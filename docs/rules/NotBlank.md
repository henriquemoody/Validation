# NotBlank

- `NotBlank()`

Validates if the given input is not a blank value (`null`, zeros, empty strings
or empty arrays, recursively).

```php
v::notBlank()->validate(null); // false
v::notBlank()->validate(''); // false
v::notBlank()->validate([]); // false
v::notBlank()->validate(' '); // false
v::notBlank()->validate(0); // false
v::notBlank()->validate('0'); // false
v::notBlank()->validate(0); // false
v::notBlank()->validate('0.0'); // false
v::notBlank()->validate(false); // false
v::notBlank()->validate(['']); // false
v::notBlank()->validate([' ']); // false
v::notBlank()->validate([0]); // false
v::notBlank()->validate(['0']); // false
v::notBlank()->validate([false]); // false
v::notBlank()->validate([[''], [0]]); // false
v::notBlank()->validate(new stdClass()); // false
```

It's similar to [NotEmpty](NotEmpty.md) but it's way more strict.

## Categorization

- Miscellaneous

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
