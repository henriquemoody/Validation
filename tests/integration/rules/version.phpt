--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::version()->assert('1.3.7--'));
exceptionMessage(static fn() => v::not(v::version())->assert('1.0.0-alpha'));
exceptionFullMessage(static fn() => v::version()->assert('1.2.3.4-beta'));
exceptionFullMessage(static fn() => v::not(v::version())->assert('1.3.7-rc.1'));
?>
--EXPECT--
"1.3.7--" must be a version
"1.0.0-alpha" must not be a version
- "1.2.3.4-beta" must be a version
- "1.3.7-rc.1" must not be a version
