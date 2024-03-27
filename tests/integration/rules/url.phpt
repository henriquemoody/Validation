--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::url()->check('example.com'));
exceptionMessage(static fn() => v::not(v::url())->check('http://example.com'));
exceptionFullMessage(static fn() => v::url()->assert('example.com'));
exceptionFullMessage(static fn() => v::not(v::url())->assert('http://example.com'));
?>
--EXPECT--
"example.com" must be a URL
"http://example.com" must not be a URL
- "example.com" must be a URL
- "http://example.com" must not be a URL
