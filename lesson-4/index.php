<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$adult = new \Classes\Adult('john', 38, 'male', 'doctor');

$adult->sayHello();
$adult->drinkAlcohol();
$adult->sleep();
var_dump($adult->getGender());
print PHP_EOL;

$child = new \Classes\Child('Timmy', 6, 'male', 'break things');

$child->sayHello();
$child->sleep();
$child->getGender();
var_dump($child->getGender());