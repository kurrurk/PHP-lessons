<?php

$basic = function (string $classname) {
    $file = __DIR__ . "/" . "{$classname}.php";

    if (file_exists($file)) {
        require_once($file);
    }
};

\spl_autoload_register($basic);
$blah = new Blah();
$blah->wave();

\spl_autoload_unregister($basic);


$underscore = function (string $classname) {
    $path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
    $path = __DIR__ . "/$path";
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    } else {
        echo $path;
    }
};

\spl_autoload_register($underscore);
$blah = new util_Blah();
$blah->wave();

\spl_autoload_unregister($underscore);

$namespaces = function (string $path) {
    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
    if (file_exists("{$path}.php")) { // лучше использовать \stream_resolve_include_path()
        require_once("{$path}.php");
    } else {
        echo $path;
    }
};

\spl_autoload_register($namespaces);
$blah = new util\LocalPath();
$blah->wave("namespaces");

\spl_autoload_unregister($namespaces);

$underscore = function (string $classname) {
    $path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
    $path = __DIR__ . "/$path";
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};

$namespaces = function (string $path) {
    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
    if (\stream_resolve_include_path("{$path}.php") !== 0) {
        require_once("{$path}.php");
    }
};

echo "<strong>\$underscore and \$namespaces </strong>:<br>\n";

\spl_autoload_register($namespaces);
\spl_autoload_register($underscore);
$blah = new util_Blah();
$blah->wave();
$blah = new util\LocalPath();
$blah->wave("namespaces");

\spl_autoload_unregister($namespaces);
\spl_autoload_unregister($underscore);

?>

<a href="./resolve_test/index.php">test</a>