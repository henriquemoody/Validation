--FILE--
<?php

require 'vendor/autoload.php';

run([
    'Default mode' => [v::keyExists('foo'), ['bar' => 'baz']],
    'Inverted mode' => [v::not(v::keyExists('foo')), ['foo' => 'baz']],
    'Custom name' => [v::keyExists('foo')->setName('Custom name'), ['bar' => 'baz']],
    'Custom template' => [v::keyExists('foo'), ['bar' => 'baz'], 'Custom template for `{{name}}`'],
]);
?>
--EXPECT--
Default mode
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

Inverted mode
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must not be present
- foo must not be present
[
    'foo' => 'foo must not be present',
]

Custom name
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Custom name must be present
- Custom name must be present
[
    'foo' => 'Custom name must be present',
]

Custom template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Custom template for `foo`
- Custom template for `foo`
[
    'foo' => 'Custom template for `foo`',
]
