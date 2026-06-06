<?php

$base = __DIR__;
$classname = "Task";
$path = "{$base}/tasks/{$classname}.php";

if (! file_exists($path)) {
    throw new \Exception("Файл {$path} не найден");
}

require_once($path);
$qclassname = "tasks\\$classname";

if (! class_exists($qclassname)) {
    throw new \Exception("Класс {$qclassname} не найден");
}

$maObj = new $qclassname();
$maObj->doSpeak();

echo "<pre>";
print_r(get_declared_classes());
echo "</pre>";
