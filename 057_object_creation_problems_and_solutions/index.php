<?php

abstract class Employee
{
    public function __construct(protected string $name)
    {
    }
    abstract public function fire(): void;
}

abstract class Employee2 extends Employee
{
    private static $types = ['Minion', 'CluedUp', 'WellConnected'];
    public static function recruit(string $name): Employee
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = __NAMESPACE__ . "\\" . self::$types[$num];
        return new $class($name);
    }
}

class Minion extends Employee2
{
    #[Override]
    public function fire(): void
    {
        print "{$this->name}: я уберу со стола<br>\n";
    }
}

class NastyBoss
{
    private array $employees = [];
    public function addEmployee(string $employeeName): void
    {
        $this->employees[] = new Minion($employeeName);
    }
    public function projectFails(): void
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

class NastyBoss2
{
    private array $employees = [];
    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }
    public function projectFails(): void
    {
        if (count($this->employees)) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

class CluedUp extends Employee2
{
    public function fire(): void
    {
        print "{$this->name}: я вызыву адвоката<br>\n";
    }
}

class WellConnected extends Employee2
{
    public function fire(): void
    {
        print "{$this->name}: я позвоню папе<br>\n";
    }
}

// Визуальный пример

echo "<pre>";
echo "----------------------------<br/>\n";

$boss = new NastyBoss();
$boss->addEmployee('Harry');
$boss->addEmployee('Bob');
$boss->addEmployee('Mary');
$boss->projectFails();

echo "----------------------------<br/>\n";

$boss = new NastyBoss2();
$boss->addEmployee(new Minion('Harry'));
$boss->addEmployee(new CluedUp('Bob'));
$boss->addEmployee(new WellConnected('Mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();

echo "----------------------------<br/>\n";

$boss = new NastyBoss2();
$boss->addEmployee(Employee2::recruit('Harry'));
$boss->addEmployee(Employee2::recruit('Bob'));
$boss->addEmployee(Employee2::recruit('Mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();

echo "----------------------------<br/>\n";
echo "</pre>";
