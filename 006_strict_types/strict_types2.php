<?php

require_once __DIR__ . "/Shop_product.php";

// Deprecated: ConfReader::getValues(): Implicitly marking parameter $default as nullable is deprecated, the explicit nullable type must be used instead.
class ConfReader
{
    public function getValues(?array $default = null): array // новый синтаксис для указания nullable типа
    {
        $values = [];

        // выполнить действия для получения новых значений
        // добавить переданные значения
        // (результат всегда будет массивом)

        $values = array_merge($values, $default ?? []); // если $default не null, то использовать его, иначе использовать пустой массив, чтобы избежать ошибки при попытке объединить массив с null
        return $values;
    }
}

echo "ConfReader()::getValues() : ";
var_dump((new ConfReader())->getValues());
echo "<br/>\n-----------------------------<br/>\n";
var_dump(new ConfReader());
echo "<br/>\n-----------------------------<br/>\n";

// пример использования типа mixed

class Storage_mixed
{
    public function add(string $key, mixed $value): void // новый синтаксис для указания типа mixed а также для указания возвращаемого псевдотипа void
    {
        // Действия с $key и $value
    }
}

var_dump(new Storage_mixed());
echo "<br/>\n-----------------------------<br/>\n";
// пример использования объявления типов и объявления возвращаемого типа с объединением типов

class Storage_no_union
{
    public function add(string $key, $value): int|bool // реализация до PHP 8.0, где объединение типов не поддерживалось
    {
        if (! is_bool($value) && ! is_string($value)) {
            error_log("Значение должно быть строкой или булевым, а не  " . gettype($value));
            return false;
        }
        // Действия с $key и $value
        return 0;
    }
}

var_dump(new Storage_no_union());
echo "<br/>\n-----------------------------<br/>\n";

class Storage_union
{
    public function add(string $key, string|bool|null $value): void
    {
        // Действия с $key и $value
    }

    // пример использования псевдотипа false
    public function setShopProduct(ShopProduct|false $product): void
    {
        // Действия с $product
    }
}

var_dump(new Storage_union());
