--FILE--
<?php

require_once 'vendor/autoload.php';

exceptionMessage(static fn() => v::control()->assert('16-50'));
exceptionMessage(static fn() => v::control('16')->assert('16-50'));
exceptionMessage(static fn() => v::not(v::control())->assert("\n"));
exceptionMessage(static fn() => v::not(v::control('16'))->assert("16\n"));
exceptionFullMessage(static fn() => v::control()->assert('Foo'));
exceptionFullMessage(static fn() => v::control('Bar')->assert('Foo'));
exceptionFullMessage(static fn() => v::not(v::control())->assert("\n"));
exceptionFullMessage(static fn() => v::not(v::control('Bar'))->assert("Bar\n"));
?>
--EXPECT--
"16-50" must only contain control characters
"16-50" must only contain control characters and "16"
"\n" must not contain control characters
"16\n" must not contain control characters or "16"
- "Foo" must only contain control characters
- "Foo" must only contain control characters and "Bar"
- "\n" must not contain control characters
- "Bar\n" must not contain control characters or "Bar"