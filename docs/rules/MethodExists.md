# MethodExists

- `MethodExists(string $methodName)`

Validates whether a method from a given class exists or not.

```php
v::methodExists('getArrayCopy')->validate(new ArrayObject()); // true
v::methodExists('count')->validate(Countable::class); // true
```

[categorization]: Introspection


## Changelog

Version | Description
--------|-------------
  2.2.0 | Created

***
See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [Nif](Nif.md)
