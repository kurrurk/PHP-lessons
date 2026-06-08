<?php

class Person
{
    public function __construct(public string $name)
    {
    }
}

interface Module
{
    public function execute(): void;
}

class FtpModule implements Module
{
    public function setHost(string $host): void
    {
        print "FtpModule::setHost(): $host<br>\n";
    }
    public function setUser(string|int $user): void
    {
        print "FtpModule::setUser(): $user<br>\n";
    }
    #[Override]
    public function execute(): void
    {
        // некоторые действия
    }
}

class PersonModule implements Module
{
    public function setPerson(Person $person): void
    {
        print "PersonModule::setPerson(): $person->name<br>\n";
    }
    public function execute(): void
    {
        // некоторые действия
    }
}

class Modulrunner
{
    private array $configData = [
        PersonModule::class => ['person' => 'bob'],
        FtpModule::class => [
            'host' => 'example.com',
            'user' => 'anon',
        ],
    ];
    private array $modules = [];

    public function init(): void
    {
        $interface = new \ReflectionClass(Module::class);
        foreach ($this->configData as $moduleName => $params) {
            $module_class = new \ReflectionClass($moduleName);

            if (! $module_class->isSubclassOf($interface)) {
                throw new Exception("Неизвестный тип модуля: $moduleName");
            }

            $module = $module_class->newInstance();

            foreach ($module_class->getMethods() as $method) {
                $this->handleMethod($module, $method, $params);
                // Метод будет добавлен позже
            }

            array_push($this->modules, $module);
        }
    }
    //..
}

$test = new Modulrunner();
$test->init();
