# ArrayType

- `ArrayType()`

Validates whether the type of an input is array.

```php
v::arrayType()->isValid([]); // true
v::arrayType()->isValid([1, 2, 3]); // true
v::arrayType()->isValid(new ArrayObject()); // false
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [Countable](Countable.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [IterableType](IterableType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)