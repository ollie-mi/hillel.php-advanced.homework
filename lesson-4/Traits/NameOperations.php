<?php
declare(strict_types=1);

namespace Traits;


trait NameOperations
{
    public function ucfirstName($name):string
    {
        return ucfirst($name);
    }

    public function uppercaseName($name):string
    {
        return strtoupper($name);
    }
}