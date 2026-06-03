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

    // Можно вставить только классы реализующие интерефейс Stringable
    public static function printThing(string | \Stringable $str): void
    {
        print "Напечатано в <strong>Person</strong>::printThing -> " . $str;
    }

}

class ErrorString
{
}

$person = new Person();
$err = new ErrorString();
echo "----------------------------<br/>\n";
echo Person::printThing($person) . "<br>";
echo "----------------------------<br/>\n";
// Можно вставить только классы реализующие интерефейс Stringable
echo Person::printThing($err) . "<br>";
