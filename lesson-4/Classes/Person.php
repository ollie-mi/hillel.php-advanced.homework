<?php
declare(strict_types=1);

namespace Classes;

use Traits\NameOperations;

abstract class Person
{
    use NameOperations;

    protected string $name;
    protected int $age;
    private string $gender;
    private const MALE = 'male';
    private const FEMALE = 'female';


    public function __construct($name, $age, $gender)
    {
        $this->setName($name);
        $this->setAge($age);
        $this->setGender($gender);
    }

    private function setName ($name):void
    {
        $this->name = (string) $this->ucfirstName($name);
    }

    private function setAge ($age):void
    {
        $this->age = (int) $age;
    }

    private function setGender ($gender):void
    {
        if ($gender === self::MALE || $gender === self::FEMALE) {
            $this->gender = $gender;
        } else {
            throw new \InvalidArgumentException('Sorry! Only two options. But we respect your self determination');
        }
    }

    public function getGender():string
    {
        return $this->gender;
    }

    abstract protected function sayHello();
}