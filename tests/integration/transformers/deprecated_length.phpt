--FILE--
<?php

require_once 'vendor/autoload.php';

exceptionMessage(static fn() => v::length(0, 5, false)->assert('forest'));
exceptionMessage(static fn() => v::length(10, 20)->assert('river'));
exceptionMessage(static fn() => v::length(15, null, false)->assert('mountain'));
exceptionMessage(static fn() => v::length(20)->assert('ocean'));
exceptionMessage(static fn() => v::length(2, 5)->assert('desert'));
exceptionMessage(static fn() => v::not(v::length(0, 15))->assert('rainforest'));
exceptionMessage(static fn() => v::not(v::length(0, 20, false))->assert('glacier'));
exceptionMessage(static fn() => v::not(v::length(3, null))->assert('meadow'));
exceptionMessage(static fn() => v::not(v::length(5, null, false))->assert('volcano'));
exceptionMessage(static fn() => v::not(v::length(5, 20))->assert('canyon'));
exceptionFullMessage(static fn() => v::length(0, 5, false)->assert('prairie'));
exceptionFullMessage(static fn() => v::length(0, 5)->assert('wetland'));
exceptionFullMessage(static fn() => v::length(15, null, false)->assert('tundra'));
exceptionFullMessage(static fn() => v::length(20)->assert('savanna'));
exceptionFullMessage(static fn() => v::length(7, 10)->assert('marsh'));
exceptionFullMessage(static fn() => v::length(4, 10, false)->assert('reef'));
exceptionFullMessage(static fn() => v::not(v::length(0, 15))->assert('valley'));
exceptionFullMessage(static fn() => v::not(v::length(0, 20, false))->assert('island'));
exceptionFullMessage(static fn() => v::not(v::length(5, null))->assert('plateau'));
exceptionFullMessage(static fn() => v::not(v::length(3, null, false))->assert('fjord'));
exceptionFullMessage(static fn() => v::not(v::length(5, 20))->assert('delta'));
exceptionFullMessage(static fn() => v::not(v::length(5, 11, false))->assert('waterfall'));
exceptionFullMessage(static fn() => v::length(8, 8)->assert('estuary'));
exceptionFullMessage(static fn() => v::not(v::length(5, 5))->assert('grove'));
?>
--EXPECTF--

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(5) instead. %s
The length of "forest" must be less than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(10, 20) instead. %s
The length of "river" must be between 10 and 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(15) instead. %s
The length of "mountain" must be greater than 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(20) instead. %s
The length of "ocean" must be greater than or equal to 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(2, 5) instead. %s
The length of "desert" must be between 2 and 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThanOrEqual(15) instead. %s
The length of "rainforest" must be greater than 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(20) instead. %s
The length of "glacier" must not be less than 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(3) instead. %s
The length of "meadow" must be less than 3

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(5) instead. %s
The length of "volcano" must not be greater than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(5, 20) instead. %s
The length of "canyon" must not be between 5 and 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(5) instead. %s
- The length of "prairie" must be less than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThanOrEqual(5) instead. %s
- The length of "wetland" must be less than or equal to 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(15) instead. %s
- The length of "tundra" must be greater than 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(20) instead. %s
- The length of "savanna" must be greater than or equal to 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(7, 10) instead. %s
- The length of "marsh" must be between 7 and 10

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetweenExclusive(4, 10) instead. %s
- The length of "reef" must be greater than 4 and less than 10

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThanOrEqual(15) instead. %s
- The length of "valley" must be greater than 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(20) instead. %s
- The length of "island" must not be less than 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(5) instead. %s
- The length of "plateau" must be less than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(3) instead. %s
- The length of "fjord" must not be greater than 3

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(5, 20) instead. %s
- The length of "delta" must not be between 5 and 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetweenExclusive(5, 11) instead. %s
- The length of "waterfall" must not be greater than 5 or less than 11

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthEquals(8) instead. %s
- The length of "estuary" must be equal to 8

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthEquals(5) instead. %s
- The length of "grove" must not be equal to 5
