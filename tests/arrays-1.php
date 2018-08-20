<?php
require __DIR__ . '/../primitives.php';
require __DIR__ . '/../arrays.php';

$dummy = [1,2,3];
$dummy2 = $dummy;

$a = new anovsiradj\primitive\arrays($dummy);

var_dump($a->count() === count($a()));

array_unshift($dummy2, 1,2,3);
$a->unshift(1,2,3);

var_dump($dummy2 === $a());

$a->sort();
var_dump($a() !== $dummy2);
sort($dummy2);
var_dump($a() === $dummy2);
