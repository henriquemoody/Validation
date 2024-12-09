--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessages(static fn() => v::noWhitespace()->email()->setName('User Email')->assert('not email'));
?>
--EXPECT--
[
    '__root__' => 'All of the required rules must pass for User Email',
    'noWhitespace' => 'User Email must not contain whitespaces',
    'email' => 'User Email must be a valid email address',
]