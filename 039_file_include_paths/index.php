<?php

echo "До изменения:<br>";
echo get_include_path() . "<br><br>";

set_include_path(
    get_include_path() . PATH_SEPARATOR . __DIR__ . "/library"
);

echo "До изменения:<br>";
echo get_include_path() . "<br><br>";

require_once "MyClass.php";

$obj = new MyClass();

$obj->hello();
