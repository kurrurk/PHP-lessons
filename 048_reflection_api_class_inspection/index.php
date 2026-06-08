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
}

// объект для доступа к исходному коду класса

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
}

echo "----------------------------<br/>\n<pre>";
$cd = new CdProduct("cd1", "bob", "bobbleson", 50, 4);
var_dump($cd);
echo "</pre>----------------------------<br/>\n<pre>";
$prodclass = new \ReflectionClass(CDProduct::class);
print ClassInfo::getData($prodclass);
echo "</pre>----------------------------<br/>\n<pre>";
print ReflectionUtil::getClassSource(new \ReflectionClass(CDProduct::class));
echo "</pre>----------------------------<br/>\n<pre>";
print $prodclass;
echo "</pre>----------------------------<br/>\n";
