--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::exists()->assert('/path/of/a/non-existent/file'));
exceptionMessage(static fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::exists()->assert('/path/of/a/non-existent/file'));
exceptionFullMessage(static fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"/path/of/a/non-existent/file" must be an existing file
"tests/fixtures/valid-image.gif" must not be an existing file
- "/path/of/a/non-existent/file" must be an existing file
- "tests/fixtures/valid-image.png" must not be an existing file