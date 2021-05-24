<?php
    class StaticExample2
    {
        static public $aNum = 0;
        public static function sayHello()
        {
            $aNum = ++self::$aNum;
            print "Здравствуй, Мир - {$aNum}!";
        }
    }

    $aNum = ++StaticExample2::$aNum;
    echo "Здравствуй, Мир - {$aNum}!" . "<br/>";
    StaticExample2::sayHello();
?>
