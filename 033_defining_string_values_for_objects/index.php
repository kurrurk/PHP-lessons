<?php

class Person
{
    public function getName(): string
    {
        return "Василий";
    }
    public function getAge(): int
    {
        return 39;
    }

    public function __toString(): string
    {
        $desc = $this->getName() . " (возраст ";
        $desc .= $this->getAge() . " лет)";
        return $desc;
    }

    public static function printThing(string | \Stringable $str): void
    {
        print "Напечатано в <strong>Person</strong>::printThing -> " . $str;
    }

}

// Можно вставить только классы реализующие интерефейс Stringable


$person = new Person();
echo "----------------------------<br/>\n";
echo Person::printThing($person) . "<br>";
echo "----------------------------<br/>\n";
