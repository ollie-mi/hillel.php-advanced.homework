<?php
declare(strict_types=1);

namespace Classes;


use Interfaces\ChildCanDo;
use Traits\NameOperations;

class Child extends Person implements ChildCanDo
{
    use NameOperations;

    public string $name;
    public int $age;
    public string $hobby;

    public function __construct($name, $age, $gender, $hobby)
    {
        parent::__construct($name, $age, $gender);

        $this->setHobby($hobby);
        $this->name = $this->uppercaseName($this->name);
    }

    private function setHobby ($hobby):void
    {
        $this->hobby = (string) $hobby;
    }

    public function sayHello():void
    {
        echo 'Hello. My name is ' . $this->name . PHP_EOL . 'I am ' . $this->age  . ' years old. And my hobby is ' . $this->hobby . PHP_EOL;
    }

    public function eat():void
    {
        echo 'I hate vegetables' . PHP_EOL;
    }

    public function sleep():void
    {
        echo 'I hate sleeping' . PHP_EOL;
    }

    public function scream():void
    {
        echo 'I like screaming a lot' . PHP_EOL;
    }
}