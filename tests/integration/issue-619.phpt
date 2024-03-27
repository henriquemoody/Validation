--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::instance(stdClass::class)->setTemplate('invalid object')->assert('test'));
?>
--EXPECT--
invalid object
