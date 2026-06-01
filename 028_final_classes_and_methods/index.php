<?php

final class Checkout
{
    // ..
}

$reflection = new ReflectionClass(Checkout::class); // Reflection позволяет программе исследовать саму себя во время выполнения.

if (!$reflection->isFinal()) {
    class IllegalCheckout extends Checkout
    {
        // ..
    }
} else {
    echo "Класс <strong>Checkout</strong> является завершенным и от него нельзя наследовать<br>";
}


class Checkout2
{
    final public function totalize(): void
    {
        echo "Расчет расходов";
    }
}


$reflection = new ReflectionMethod(Checkout2::class, 'totalize'); // Reflection позволяет программе исследовать саму себя во время выполнения.

if (!$reflection->isFinal()) {
    class IllegalCheckout extends Checkout2
    {
        final public function totalize(): void
        {
            echo "Измененный код расчета";
        }
    }
} else {
    echo "Метод <strong>Checkout2::totalize()</strong> является завершенным и от него нельзя переопределить<br>";
    class IllegalCheckout extends Checkout2
    {
    }
}


echo "-------------- проверка --------------<br/>\n";
new IllegalCheckout()->totalize();
