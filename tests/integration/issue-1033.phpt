--DESCRIPTION--
The previous output was:

- All of the required rules must pass for `{ "A", "B", "B" }`
- Each item in `{ "A", "B", "B" }` must be valid
- "A" must equal 1
- "B" must equal 1
- "B" must equal 1
--FILE--
<?php

require 'vendor/autoload.php';

exceptionFullMessage(static fn() => v::each(v::equals(1))->assert(['A', 'B', 'B']));
?>
--EXPECT--
- Each item in `["A", "B", "B"]` must be valid
  - "A" must equal 1
  - "B" must equal 1
  - "B" must equal 1
