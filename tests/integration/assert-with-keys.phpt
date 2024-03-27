--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionFullMessage(static function (): void {
    v::create()
        ->key(
            'mysql',
            v::create()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType())
        )
        ->key(
            'postgresql',
            v::create()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType())
        )
        ->setName('the given data')
        ->assert([
            'mysql' => [
                'host' => 42,
                'schema' => 42,
            ],
            'postgresql' => [
                'user' => 42,
                'password' => 42,
            ],
        ]);
});
?>
--EXPECT--
- All of the required rules must pass for the given data
  - All of the required rules must pass for mysql
    - host must be of type string
    - user must be present
    - password must be present
    - schema must be of type string
  - All of the required rules must pass for postgresql
    - host must be present
    - user must be of type string
    - password must be of type string
    - schema must be present
