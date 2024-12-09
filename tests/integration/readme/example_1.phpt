--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

date_default_timezone_set('UTC');

$user = new stdClass();
$user->name = 'Alexandre';
$user->birthdate = '1987-07-01';

$userValidator = v::property('name', v::stringType()->length(v::between(1, 32)))
                  ->property('birthdate', v::dateTimeDiff('years', v::greaterThanOrEqual(18)));

$userValidator->assert($user);

echo 'Nothing to fail';
?>
--EXPECT--
Nothing to fail
