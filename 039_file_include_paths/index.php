<?php

echo "----------------------------<br/>\n";
echo "До изменения:<br>";
echo get_include_path() . "<br>";
echo "----------------------------<br/>\n";

set_include_path(
    get_include_path() . PATH_SEPARATOR . __DIR__ . "/library"
);

echo "----------------------------<br/>\n";
echo "До изменения:<br>";
echo get_include_path() . "<br>";
echo "----------------------------<br/>\n";

require_once "MyClass.php";

$obj = new MyClass();

$obj->hello();
