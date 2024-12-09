--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::isbn()->assert('ISBN-12: 978-0-596-52068-7'));
exceptionMessage(static fn() => v::not(v::isbn())->assert('ISBN-13: 978-0-596-52068-7'));
exceptionFullMessage(static fn() => v::isbn()->assert('978 10 596 52068 7'));
exceptionFullMessage(static fn() => v::not(v::isbn())->assert('978 0 596 52068 7'));
?>
--EXPECT--
"ISBN-12: 978-0-596-52068-7" must be a valid ISBN
"ISBN-13: 978-0-596-52068-7" must not be a valid ISBN
- "978 10 596 52068 7" must be a valid ISBN
- "978 0 596 52068 7" must not be a valid ISBN