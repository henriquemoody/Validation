--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::imei()->assert('490154203237512'));
exceptionMessage(static fn() => v::not(v::imei())->assert('350077523237513'));
exceptionFullMessage(static fn() => v::imei()->assert(null));
exceptionFullMessage(static fn() => v::not(v::imei())->assert('356938035643809'));
?>
--EXPECT--
"490154203237512" must be a valid IMEI number
"350077523237513" must not be a valid IMEI number
- `null` must be a valid IMEI number
- "356938035643809" must not be a valid IMEI number