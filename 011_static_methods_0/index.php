<?php

class StaticExample
{
    public static $aNum = 'Здравствуй, Мир - 1!';

    public static function sayHello()
    {
        echo 'Здравствуй, Мир - 2!<br/>';
    }
}

echo StaticExample::$aNum.'<br/>';
StaticExample::sayHello();

class StaticExample2
{
    public static $bNum = 2;

    public static function sayHello()
    {
        ++self::$bNum;
        echo 'Здравствуй, Мир - '.self::$bNum.'!<br/>';
    }
}

StaticExample2::sayHello();
