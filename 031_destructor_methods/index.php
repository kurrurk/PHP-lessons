<?php

class Person
{
    private int $id;
    public function __construct(protected string $name, private int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function __destruct()
    {
        echo "----------------------------<br/>\n";
        echo "Объект класса " . get_class($this) . " удален.<br>";
        // Сохранение данных Person
        print "Сохранение Person в базу данных...<br>";
        echo "----------------------------<br/>\n";
    }
}


// тело программы
$person = new Person("Иван", 44);
$person->setId(345);
echo "<pre>";
var_dump($person);
echo "</pre>";
unset($person);
