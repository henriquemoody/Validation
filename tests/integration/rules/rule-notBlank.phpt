--TEST--
Should validate NotBlank rule
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Factory;
use Respect\Validation\Rules\NotBlank;
use Respect\Validation\Validator;

$factory = new Factory();
$validator = new Validator($factory);
$validator->addRule(new NotBlank());

$values = [null, '', [], ' ', 0, '0', 0.0, '0.0', false, [''], [' '], [0], ['0'], [false], [[''], [0]], -1];
foreach ($values as $value) {
    echo str_pad(json_encode($validator->validate($value)), 6).': '.json_encode($value).PHP_EOL;
}
?>
--EXPECTF--
false : null
false : ""
false : []
false : " "
false : 0
false : "0"
false : 0
false : "0.0"
false : false
false : [""]
false : [" "]
false : [0]
false : ["0"]
false : [false]
false : [[""],[0]]
true  : -1
