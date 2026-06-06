<?php

namespace util;

class LocalPath
{
    public function wave(string $advice = ''): void
    {
        echo "-------------- " . $advice . " --------------<br/>\n";
        print "Привет от " . get_class($this) . "<br>";
        echo "--------------------------------------------<br/>\n";
    }
}
