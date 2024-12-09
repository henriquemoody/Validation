--FILE--
<?php

require 'vendor/autoload.php';

uopz_set_return('is_uploaded_file', false);
exceptionMessage(static fn() => v::uploaded()->assert('filename'));
uopz_set_return('is_uploaded_file', true);
exceptionMessage(static fn() => v::not(v::uploaded())->assert('filename'));
uopz_set_return('is_uploaded_file', false);
exceptionFullMessage(static fn() => v::uploaded()->assert('filename'));
uopz_set_return('is_uploaded_file', true);
exceptionFullMessage(static fn() => v::not(v::uploaded())->assert('filename'));?>
--SKIPIF--
<?php
if (!extension_loaded('uopz')) {
    echo 'skip: Extension "uopz" is required to test "Uploaded" rule';
}
?>
--EXPECT--
"filename" must be an uploaded file
"filename" must not be an uploaded file
- "filename" must be an uploaded file
- "filename" must not be an uploaded file
