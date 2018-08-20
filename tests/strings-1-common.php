<?php
require __DIR__ . '/../primitives.php';
require __DIR__ . '/../strings.php';

$s = new anovsiradj\primitive\strings;
$s->__primitive__ = 'hello world';

echo $s->md5(), PHP_EOL, $s->sha1(), PHP_EOL;

$s->__primitive__ = '   hello world   ';
echo "'{$s}'", PHP_EOL, "'{$s->trim()}'", PHP_EOL;

$s->__primitive__ = 'anovsiradj';
echo
$s->replace('a','4')->replace('o','0')->replace('i','1'), PHP_EOL,
$s->rot13(), PHP_EOL;

$s->__primitive__ = 'hi all i say hello';
echo $s->replace_multiple(['hi' => 'hello', 'hello' => 'hi']), PHP_EOL;
