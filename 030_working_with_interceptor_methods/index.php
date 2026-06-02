<?php

class Person
{
    public ?string $myname;
    public null|int|float $myage;
    public function __get(string $property): mixed
    {
        $method = "get{$property}";

        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }
    public function __set(string $property, mixed $value): void
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            $this->$method($value);
        }

    }
    public function __unset(string $property): void
    {
        $method = "set{$property}";

        if (method_exists($this, $method)) {
            $this->$method(null);
        }
    }

    public function __isset(string $property): bool
    {
        $method = "get{$property}";

        return method_exists($this, $method);
    }

    public function getName()
    {
        return "Василий";
    }
    public function getAge()
    {
        return 39;
    }

    public function setName(?string $name): void
    {
        $this->myname = $name;
        if (!is_null($name)) {
            $this->myname = strtoupper($this->myname);
        }
    }
    public function setAge(?float $age): void
    {
        $this->myage = $age;
        if (!is_null($age)) {
            $this->myage = round($age);
        }
    }
}

class PersonWithCall extends Person
{
    public function __construct(private PersonWriter $writer)
    {

    }

    public function __call(string $method, array $args)
    {
        if (method_exists($this->writer, $method)) {
            return $this->writer->$method($this);
        }
    }
}

class PersonWriter
{
    public function writeName(Person $p): void
    {
        print $p->getName() . "<br>";
    }

    public function writeAge(Person $p): void
    {
        print $p->getAge() . "<br>";
    }
}

class Address
{
    private string $number;
    private string $street;
    public function __construct(string $maybenumber, ?string $maybestreet = null)
    {
        if (is_null($maybestreet)) {
            $this->streetaddress = $maybenumber;
        } else {
            $this->number = $maybenumber;
            $this->street = $maybestreet;
        }
    }
    public function __set(string $property, mixed $value): void
    {
        if ($property === "streetaddress") {
            if (preg_match("/^(\d+.*?)[\s,]+(.+)$/", $value, $matches)) {
                $this->number = $matches[1];
                $this->street = $matches[2];
            } else {
                throw new \Exception("Ошибка анализа адреса: '{$value}'");
            }
        }
    }
    public function __get(string $property): mixed
    {
        if ($property === "streetaddress") {
            return $this->number . " " . $this->street;
        }
    }
}

$p = new PersonWithCall(new PersonWriter());

// тело программы

echo "----------------------------<br/>\n";
echo "Когда клиентский код пытается получить доступ к неопределённому свойству, вызывается метод __get(). ";
echo "К переданному ему имени свойства метод __get() добавляет префикс get и передаёт результат методу method_exists(). ";
echo "Методу method_exists() также передаётся ссылка на объект, в котором выполняется поиск данного метода. ";
echo "Если метод найден, он будет вызван и выполнен.<br>";
echo "----------------------------<br/>\n";

print $p->name . ': ' . $p->age . "<br>";

echo "----------------------------<br/>\n";
echo "Метод __isset() вызывается после того, как в клиентском коде для неопределённого свойства вызывается функция isset(). ";
echo "Теперь в классе Person функция isset() возвращает true, если существует метод get[Свойство], возвращающий значение.<br>";
echo "----------------------------<br/>\n";

if (isset($p->name)) {
    print $p->name . "<br>";
}

echo "----------------------------<br/>\n";

echo "<pre>";
var_dump($p);
echo "</pre>";

echo "----------------------------<br/>\n";
echo "Если пользователь пытается присвоить значение неопределённому свойству, вызывается метод __set(), которому будут переданы имя этого свойства и присваиваемое ему значение. ";
echo "То, как именно это значение будет использовано далее, зависит от конкретной реализации метода __set().<br>";
echo "----------------------------<br/>\n";

$p->name = "cтепан";
$p->age = 39.5;
print $p->myname . ': ' . $p->myage . "<br>";

echo "----------------------------<br/>\n";

echo "<pre>";
var_dump($p);
echo "</pre>";

echo "----------------------------<br/>\n";
echo "Метод __unset() вызывается после того, как в клиентском коде для неопределённого свойства вызывается функция unset(). ";
echo "То, как именно это значение будет использовано далее, зависит от конкретной реализации метода __unset().<br>";
echo "----------------------------<br/>\n";

unset($p->myname);
unset($p->myage);

echo "<pre>";
var_dump($p);
echo "</pre>";

echo "----------------------------<br/>\n";
echo "Метод __call() вызывается в том случае, если клиентский код обращается к неопределённому методу. ";
echo "При этом методу __call() передаётся имя несуществующего метода и массив, содержащий все аргументы, переданные клиентом. ";
echo "Метод __call() применяется для делегирования — это механизм, с помощью которого один объект может вызывать метод другого объекта.<br>";
echo "----------------------------<br/>\n";

echo "<strong>Имя</strong>: ";
$p->writeName();
echo "<strong>Возраст</strong>: ";
$p->writeAge();

echo "----------------------------<br/>\n";
echo "Методы перехватчики __get() и __set() можно так же применять для поддержки составных свойств. ";
echo "Они могут создавать определенные удобства для программиста, разрабатывающего клиентский код.<br>";
echo "----------------------------<br/>\n";

$address = new Address("221б, Бейкер-стрит");

echo "<pre>";
var_dump($address);
echo "</pre>";
echo "Адрес(получен через __get()): " . $address->streetaddress . "<br>";
