<?php

namespace com\getinstance\util
{
    class Debug
    {
        public static function helloWorld(): void
        {
            echo "---------------getinstance_util.php----------------<br/>\n";
            print "Привет от " . __NAMESPACE__ . "\\Debug<br>\n";
            echo "-------------------------------------------------------<br/>\n";
        }
    }
}

namespace other
{
    echo "<strong>other</strong>:<br>\n";
    \com\getinstance\util\Debug::helloWorld();
}
