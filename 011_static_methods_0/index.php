<?php

class StaticExample
{
    public static $aNum = "Здравствуй, Мир - 1!";
    public static function sayHello()
    {
        print "Здравствуй, Мир - 2!";
    }
}

echo StaticExample::$aNum . "<br/>";
StaticExample::sayHello();
