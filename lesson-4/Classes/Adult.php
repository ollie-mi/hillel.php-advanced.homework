<?php
declare(strict_types=1);

namespace Classes;


use Interfaces\AdultCanDo;
use Interfaces\ChildCanDo;

class Adult extends Person implements AdultCanDo, ChildCanDo
{
    public string $name;
    public int $age;
    public string $profession;

    public function __construct($name, $age, $gender, $profession)
    {
        parent::__construct($name, $age, $gender);

        $this->setProfession($profession);
    }

    private function setProfession ($profession):void
    {
        $this->profession = (string) $profession;
    }

    public function sayHello():void
    {
        echo 'Hello. My name is ' . $this->name . PHP_EOL . 'I am ' . $this->age  . ' years old. And I am a ' . $this->profession . PHP_EOL;
    }

    public function work():void
    {
        echo 'I can work' . PHP_EOL;
    }

    public function payBills():void
    {
        echo 'I can pay bills, but I am not happy about that' . PHP_EOL;
    }

    public function drinkAlcohol():void
    {
        echo 'Is it Friday already?' . PHP_EOL;
    }

    public function eat():void
    {
        echo 'I do love to eat!' . PHP_EOL;
    }

    public function sleep():void
    {
        echo 'Sleep? What is it?' . PHP_EOL;
    }

    public function scream():void
    {
       echo "I do't like it, but I have to" . PHP_EOL;
    }

}