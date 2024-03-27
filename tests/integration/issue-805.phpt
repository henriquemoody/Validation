--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessages(static function (): void {
    v::key('email', v::email()->setTemplate('WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']);
});
?>
--EXPECT--
[
    'email' => 'WRONG EMAIL!!!!!!',
]
