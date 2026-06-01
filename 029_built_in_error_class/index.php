<?php

try {
    eval("Некорректный код!");
} catch (\Error $e) {
    echo "-------------- Перехват ошибки синтаксического анализа: --------------<br/>\n";
    print get_class($e) . "<br>";
    print $e->getMessage();
} catch (\Exception $e) {
    echo "Обработка исключения Exception";
}
