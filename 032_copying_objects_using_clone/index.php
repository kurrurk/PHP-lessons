<?php

class CopyMe
{
}

$first = new CopyMe();
$second = $first;

// В версии PHP 4 переменные $second
// и $first - два разных оъбекта.
// Начиная с версии PHP 5 переменные $second
// и $first ссылаются на один и тот же объект

$third = clone $first;
// В версии PHP 5 переменные $third
// и $first ссылаются на два разных оъбекта.

class Account
{
    public function __construct(public float $balance)
    {
    }
}

class Person
{
    private int $id = 0;
    public function __construct(
        protected string $name,
        private int $age,
        public Account $account
    ) {
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function __clone(): void
    {
        $this->id = 0;
    }
}

class PersonFixedBalance extends Person
{
    #[Override]
    public function __clone(): void
    {
        parent::__clone();
        $this->account = clone $this->account;
    }
}

$person = new Person("Иван", 44, new Account(199.99));
$person->setId(346);
echo "<pre>";
var_dump($person);
echo "</pre>";
$person2 = clone $person;
// Добавим $person немного денег
$person->account->balance += 10;
// Это отразиться и на $person2
echo "----------------------------<br/>\n";
echo "Добавим \$person немного денег. ";
print "<strong>Баланс <em>\$person</em></strong>:" . $person->account->balance . "<br>";
echo "----------------------------<br/>\n";
echo "<pre>";
var_dump($person);
echo "</pre>";
echo "----------------------------<br/>\n";
echo "Это отразиться и на \$person2. ";
print "<strong>Баланс <em>\$person2</em></strong>:" . $person2->account->balance . "<br>";
echo "----------------------------<br/>\n";
echo "<pre>";
var_dump($person2);
echo "</pre>";

$person_fix = new PersonFixedBalance("Иван", 44, new Account(200));
$person_fix->setId(347);
echo "<pre>";
var_dump($person_fix);
echo "</pre>";
$person_fix2 = clone $person_fix;
// Добавим $person немного денег
$person_fix->account->balance += 10;
// Это отразиться и на $person2
echo "----------------------------<br/>\n";
echo "Добавим \$person_fix немного денег. ";
print "<strong>Баланс <em>\$person_fix</em></strong>:" . $person_fix->account->balance . "<br>";
echo "----------------------------<br/>\n";
echo "<pre>";
var_dump($person_fix);
echo "</pre>";
echo "----------------------------<br/>\n";
echo "Это не отразиться на \$person_fix2. ";
print "<strong>Баланс <em>\$person_fix2</em></strong>:" . $person_fix2->account->balance . "<br>";
echo "----------------------------<br/>\n";
echo "<pre>";
var_dump($person_fix2);
echo "</pre>";
