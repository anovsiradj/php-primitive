<?php
require __DIR__ . '/../primitives.php';
require __DIR__ . '/../strings.php';

$s = new anovsiradj\primitive\strings('qwaszx');

var_dump($s->length() === strlen($s));
