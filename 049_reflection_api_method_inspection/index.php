<?php

require_once("./ShopProduct.php");

class ClassInfo
{
    public static function getData(\ReflectionClass $class): string
    {
        $details = "";
        $name = $class->getName();
        $details .= ($class->isUserDefined()) ? "$name - определен пользователем<br>\n" : "";
        $details .= ($class->isInternal()) ? "$name - встроенный класс<br>\n" : "";
        $details .= ($class->isInterface()) ? "$name - интерфейс<br>\n" : "";
        $details .= ($class->isAbstract()) ? "$name - абстрактный класс<br>\n" : "";
        $details .= ($class->isFinal()) ? "$name - завершенный класс<br>\n" : "";
        $details .= ($class->isInstantiable()) ? "$name может быть инстанцирован<br>\n" : "$name не может быть инстанцирован<br>\n";
        $details .= ($class->isCloneable()) ? "$name может быть клонирован\n" : "$name не может быть клонирован<br>\n";

        return $details;
    }

    public static function methodData(\ReflectionMethod $method): string
    {
        $details = "";
        $name = $method->getName();
        $details .= ($method->isUserDefined()) ? "$name - определен пользователем<br>\n" : "";
        $details .= ($method->isInternal()) ? "$name - встроенный метод<br>\n" : "";
        $details .= ($method->isAbstract()) ? "$name - абстрактный метод<br>\n" : "";
        $details .= ($method->isPublic()) ? "$name - открытый метод<br>\n" : "";
        $details .= ($method->isProtected()) ? "$name - защищенный метод<br>\n" : "";
        $details .= ($method->isPrivate()) ? "$name - закрытый метод<br>\n" : "";
        $details .= ($method->isStatic()) ? "$name - статический метод<br>\n" : "";
        $details .= ($method->isFinal()) ? "$name - завершенный класс<br>\n" : "";
        $details .= ($method->isConstructor()) ? "$name - конструктор<br>\n" : "";
        $details .= ($method->returnsReference()) ? "$name - возвращает ссылку (а не значение)\n" : "";

        return $details;
    }
}

// объект для доступа к исходному коду метода

class ReflectionUtil
{
    public static function getClassSource(\ReflectionClass $class): string
    {
        $path = $class->getFileName();
        $lines = @file($path);
        $from = $class->getStartLine();
        $to = $class->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }

    public static function getMethodSource(\ReflectionMethod $method): string
    {
        $path = $method->getFileName();
        $lines = @file($path);
        $from = $method->getStartLine();
        $to = $method->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }
}

$cd = new CdProduct("cd1", "Антонио", "Вивальди", 50, 4);
$classname = CdProduct::class;

// Строка класс/метод - устаревший способ с версии PHP 8.4
// $rmethod1 = new \ReflectionMethod("{$classname}::construct");
// имя класса имя метода
$rmethod2 = new \ReflectionMethod($classname, "__construct");
// Объект и имя метода
$rmethod3 = new \ReflectionMethod($cd, "__construct");

// далее мы используем ReflectionClass::getMethods();

$prodclass = new \ReflectionClass(CDProduct::class);
$methods = $prodclass->getMethods();
$method = $prodclass->getMethod('getSummaryLine');

echo "<pre>";

echo "----------------------------<br/>\n";
print ReflectionUtil::getMethodSource($method) . "<br>";
echo "----------------------------<br/>\n";

foreach ($methods as $method) {

    echo "----------------------------<br/>\n";
    print ClassInfo::methodData($method);
    echo "----------------------------<br/>\n";

}
echo "</pre>";
