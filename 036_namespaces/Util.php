<?php

namespace popp\ch05\batch04\util;

// Общая структура пространства имён:
// организация или проект \ пакет

// В данном примере:
// название книги (popp) \ глава (ch05) \ группа примеров (batch04) \ категория исходного кода (util)

class Debug
{
    public static function helloWorld(string $place): void
    {
        echo "---------------Util.php----------------<br/>\n";
        print "<strong>" . $place . ":</strong><br>\n";
        print "Привет от Debug<br>\n";
        echo "------------------------------------------<br/>\n";
    }
}

class TreeLister
{
    public static function helloWorld(): void
    {
        echo "----------------Util.php----------------<br/>\n";
        print "Привет из ". __NAMESPACE__ ."<br>\n";
        echo "------------------------------------------<br/>\n";
    }
}




Debug::helloWorld("Вызов из текущего пространства имен (popp\\ch05\\batch04\\util)");
