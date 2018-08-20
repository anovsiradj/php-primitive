<?php
require __DIR__ . '/../primitives.php';
require __DIR__ . '/../arrays.php';
$a = new anovsiradj\primitive\arrays();

$data = $a->__primitive__ = ['a', 'b', 'c'];
var_dump($a->has('a') === in_array('a', $data));

$data = $a->__primitive__ = ['a' => 1, 'b' => 2, 'c' => 3];
var_dump($a->key_exists('a') === array_key_exists('a', $data));

$data = $a->__primitive__ = ['a' => 1, 'b' => 2, 'c' => 3];
$a->change_key_case(CASE_UPPER);
var_dump($a() === array_change_key_case($data,CASE_UPPER));

$data = $a->__primitive__ = [
	['a' => 1, 'b' => 2, 'c' => 3],
	['a' => 2, 'b' => 3, 'c' => 1],
	['a' => 3, 'b' => 1, 'c' => 2],
];
$a->column('a');
var_dump($a() === array_column($data, 'a'));

$data = $a->__primitive__ = ['a', 'b', 'c'];
$a->combine($a());
var_dump($a() === array_combine($data, $data));
