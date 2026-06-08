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

    public static function argData(\ReflectionParameter $arg): string
    {
        $details = "";
        $declaringclass = $arg->getDeclaringClass();
        $name = $arg->getName();
        $position = $arg->getPosition();
        $details .= "\$$name имеет позицию $position<br>\n";

        if ($arg->hasType()) {
            $type = $arg->getType();
            $typenames = [];

            if ($type instanceof \ReflectionUnionType) {
                $types = $type->getTypes();
                foreach ($types as $utype) {
                    $typenames[] = $utype->getName();
                }
            } elseif ($type instanceof \ReflectionNamedType) {

                $typenames[] = $type->getName();

            }
            $typename = implode("|", $typenames);
            $details = "\$$name должен иметь тип {$typename}<br>\n";
        }

        if ($arg->isPassedByReference()) {
            $details .= "\$$name передается по ссылке<br>\n";
        }
        if ($arg->isDefaultValueAvailable()) {
            $def = $arg->getDefaultValue();
            $details .= "\$$name имеет значение по умолчанию: $def<br>\n";
        }
        if ($arg->getType()?->allowsNull()) {
            $details .= "\$$name может быть null<br>\n";
        }

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

$classname = CdProduct::class;

$rparam1 = new \ReflectionParameter([$classname, "__construct"], 1);
$rparam2 = new \ReflectionParameter([$classname, "__construct"], "producerMainName");

$cd = new CdProduct("cd1", "Антонио", "Вивальди", 50, 4);
$rparam3 = new \ReflectionParameter([$cd, "__construct"], 1);
$rparam4 = new \ReflectionParameter([$cd, "__construct"], "producerMainName");

$prodclass = new \ReflectionClass(CDProduct::class);
$method = $prodclass->getMethod('__construct');
$params = $method->getParameters();

echo "<pre>";

foreach ($params as $param) {

    echo "----------------------------<br/>\n";
    print ClassInfo::argData($param);
    echo "----------------------------<br/>\n";

}
echo "</pre>";
