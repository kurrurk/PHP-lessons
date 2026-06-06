<?php

set_include_path(
    get_include_path()
    . PATH_SEPARATOR
    . dirname(__DIR__)
);

$namespaces = function (string $path) {
    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
    if ($file = \stream_resolve_include_path("{$path}.php")) { // stream_resolve_include_path() ищет файлы не везде на диске, а только в папках, перечисленных в include_path.
        require_once($file);
    } else {
        echo \stream_resolve_include_path("{$path}.php");
    }
};

\spl_autoload_register($namespaces);
$blah = new util\LocalPath();
$blah->wave('namespace in "/resolve_test"');

spl_autoload_unregister($namespaces);
