<?php

namespace main;

require_once __DIR__ . "/useful/Outputter.php";
require_once __DIR__ . "/Outputter.php";
require_once __DIR__ . "/Util.php";
require_once __DIR__ . "/Core.php";
require_once __DIR__ . "/TreeLister.php";
require_once __DIR__ . "/Getinstance_util.php";


\popp\ch05\batch04\util\Debug::helloWorld("Вызов за пределами текущего пространства имен");

use popp\ch05\batch04\util; // импортируется пространство имен. Поиск пространства имен указанного в качестве аргумента начинается с глобального.

util\Debug::helloWorld("Вызов за пределами текущего пространства имен");

use popp\ch05\batch04\util\Debug;

Debug::helloWorld("Вызов за пределами текущего пространства имен");

use popp\ch05\batch04\Debug as CoreDebug;

CoreDebug::helloWorld("Вызов за пределами текущего пространства имен");

use popp\ch05\batch04\util\TreeLister;

TreeLister::helloWorld();
\TreeLister::helloWorld();
