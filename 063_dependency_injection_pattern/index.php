<?php

include_once "./Inject.php";
include_once "./ApptEncoder.php";
include_once "./TerrainFactory.php";

class AppointmentMaker
{
    public function makeAppointment(): string
    {
        $encoder = new BloggsApptEncoder();
        return $encoder->encode();
    }
}

class AppointmentMaker2
{
    public function __construct(private ApptEncoder $encoder)
    {
    }
    public function makeAppointment(): string
    {
        return $this->encoder->encode();
    }
}

class AppointmentMaker3
{
    private ApptEncoder $encoder;

    #[Inject(ApptEncoder::class)]
    public function __construct(ApptEncoder $encoder)
    {
        $this->encoder = $encoder;
    }
    public function makeAppointment(): string
    {
        return $this->encoder->encode();
    }
}

class ObjectAssembler
{
    private array $components = [];
    public function __construct(string $conf)
    {
        $this->configure($conf);
    }
    private function configure(string $conf): void
    {
        $data = simplexml_load_file($conf);
        foreach ($data->class as $class) {
            $name = (string)$class['name'];
            $resolvedname = $name;
            if (isset($class->instance)) {
                if (isset($class->instance[0])) {
                    $resolvedname = (string)$class->instance[0]['inst'];
                }
            }

            $this->components[$name] = function () use ($resolvedname) {
                $rclass = new \ReflectionClass($resolvedname);
                return $rclass->newInstance();
            };
        }
    }
    public function getComponent(string $class): object
    {
        $inst = null;
        if (isset($this->components[$class])) {
            $inst = $this->components[$class]();
        } else {
            $rclass = new \ReflectionClass($class);
            $inst = $rclass->newInstance();
        }

        return $inst;
    }
}

class ObjectAssembler2
{
    private array $components = [];
    public function __construct(string $conf)
    {
        $this->configure($conf);
    }
    private function configure(string $conf): void
    {
        $data = simplexml_load_file($conf);
        foreach ($data->class as $class) {
            $args = [];
            $name = (string)$class['name'];
            $resolvedname = $name;
            foreach ($class->arg as $arg) {
                $argclass = (string)$arg['inst'];
                $args[(int)$arg['num']] = $argclass;
            }
            if (isset($class->instance)) {
                if (isset($class->instance[0])) {
                    $resolvedname = (string)$class->instance[0]['inst'];
                }
            }
            ksort($args);
            $this->components[$name] = function () use ($resolvedname, $args) {
                $expandedargs = [];
                foreach ($args as $arg) {
                    $expandedargs[] = $this->getComponent($arg);
                }
                $rclass = new \ReflectionClass($resolvedname);
                return $rclass->newInstanceArgs($expandedargs);
            };
        }
    }
    public function getComponent(string $class): object
    {
        $inst = null;
        if (isset($this->components[$class])) {
            $inst = $this->components[$class]();
        } else {
            $rclass = new \ReflectionClass($class);
            $inst = $rclass->newInstance();
        }

        return $inst;
    }
}

class ObjectAssembler3
{
    private array $components = [];
    public function __construct(string $conf)
    {
        $this->configure($conf);
    }
    private function configure(string $conf): void
    {
        $data = simplexml_load_file($conf);
        foreach ($data->class as $class) {
            $args = [];
            $name = (string)$class['name'];
            $resolvedname = $name;
            foreach ($class->arg as $arg) {
                $argclass = (string)$arg['inst'];
                $args[(int)$arg['num']] = $argclass;
            }
            if (isset($class->instance)) {
                if (isset($class->instance[0]['inst'])) {
                    $resolvedname = (string)$class->instance[0]['inst'];
                }
            }
            ksort($args);
            $this->components[$name] = function () use ($resolvedname, $args) {
                $expandedargs = [];
                foreach ($args as $arg) {
                    $expandedargs[] = $this->getComponent($arg);
                }
                $rclass = new \ReflectionClass($resolvedname);
                return $rclass->newInstanceArgs($expandedargs);
            };
        }
    }
    public function getComponent(string $class): object
    {
        // Создание $inst - экземпляр нашего объекта
        // и список объектов \ReflectionMethod
        $inst = null;
        if (isset($this->components[$class])) {
            $inst = $this->components[$class]();
            $rclass = new \ReflectionClass($inst::class);
            $methods = $rclass->getMethods();
        } else {
            $rclass = new \ReflectionClass($class);
            $methods = $rclass->getMethods();
            $injectconstructor = null;
            foreach ($methods as $method) {
                foreach ($method->getAttributes(InjectConstructor::class) as $attribute) {
                    $injectconstructor = $attribute;
                    break;
                }
            }
            if (is_null($injectconstructor)) {
                $inst = $rclass->newInstance();
            } else {
                $constructorargs = [];
                foreach ($injectconstructor->getArguments() as $arg) {
                    $constructorargs[] = $this->getComponent($arg);
                }
                $inst = $rclass->newInstanceArgs($constructorargs);
            }
        }

        return $inst;
    }
}

class ObjectAssembler4
{
    private array $components = [];
    public function __construct(string $conf)
    {
        $this->configure($conf);
    }
    private function configure(string $conf): void
    {
        $data = simplexml_load_file($conf);
        foreach ($data->class as $class) {
            $args = [];
            $name = (string)$class['name'];
            $resolvedname = $name;
            foreach ($class->arg as $arg) {
                $argclass = (string)$arg['inst'];
                $args[(int)$arg['num']] = $argclass;
            }
            if (isset($class->instance)) {
                if (isset($class->instance[0]['inst'])) {
                    $resolvedname = (string)$class->instance[0]['inst'];
                }
            }
            ksort($args);
            $this->components[$name] = function () use ($resolvedname, $args) {
                $expandedargs = [];
                foreach ($args as $arg) {
                    $expandedargs[] = $this->getComponent($arg);
                }
                $rclass = new \ReflectionClass($resolvedname);
                return $rclass->newInstanceArgs($expandedargs);
            };
        }
    }
    public function getComponent(string $class): object
    {
        // Создание $inst - экземпляр нашего объекта
        // и список объектов \ReflectionMethod
        $inst = null;
        if (isset($this->components[$class])) {
            $inst = $this->components[$class]();
            $rclass = new \ReflectionClass($inst::class);
            $methods = $rclass->getMethods();
        } else {
            $rclass = new \ReflectionClass($class);
            $methods = $rclass->getMethods();
            $injectconstructor = null;
            foreach ($methods as $method) {
                foreach ($method->getAttributes(InjectConstructor::class) as $attribute) {
                    $injectconstructor = $attribute;
                    break;
                }
            }
            if (is_null($injectconstructor)) {
                $inst = $rclass->newInstance();
            } else {
                $constructorargs = [];
                foreach ($injectconstructor->getArguments() as $arg) {
                    $constructorargs[] = $this->getComponent($arg);
                }
                $inst = $rclass->newInstanceArgs($constructorargs);
            }
        }
        $this->injectMethods($inst, $methods);
        return $inst;
    }

    public function injectMethods(object $inst, array $methods)
    {
        foreach ($methods as $method) {
            foreach ($method->getAttributes(Inject::class) as $attribute) {
                $args = [];
                foreach ($attribute->getArguments() as $argstring) {
                    $args[] = $this->getComponent($argstring);
                }
                $method->invokeArgs($inst, $args);
            }
        }
    }
}

echo "<pre>";
echo "----------------------------<br/>\n";
$assembler = new ObjectAssembler("./encoders.xml");
$encoder = $assembler->getComponent(ApptEncoder::class);
$apptmaker = new AppointmentMaker2($encoder);
$out = $apptmaker->makeAppointment();
print $out ;
$encoder = $assembler->getComponent(MegaApptEncoder::class);
$apptmaker = new AppointmentMaker2($encoder);
$out = $apptmaker->makeAppointment();
print $out ;
$assembler = new ObjectAssembler2("./terraObjects.xml");
$apptmaker = $assembler->getComponent(AppointmentMaker2::class);
$out = $apptmaker->makeAppointment();
print $out ;
$assembler = new ObjectAssembler3("./config.xml");
$terrainfactory = $assembler->getComponent(TerrainFactory::class);
$plains = $terrainfactory->getPlains(); //MarsPlains
var_dump($plains);
print "<br/>";
$assembler = new ObjectAssembler4("./terraObjects.xml");
$apptmaker = $assembler->getComponent(AppointmentMaker2::class);
$out = $apptmaker->makeAppointment();
print $out ;
echo "----------------------------<br/>\n";
echo "</pre>";
