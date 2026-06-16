<?php

abstract class Lesson
{
    public const FIXED = 1;
    public const TIMED = 2;
    public function __construct(
        protected int $duration,
        private int $costtype = 1
    ) {
    }
    public function cost(): int
    {
        switch ($this->costtype) {
            case self::TIMED:
                return (5 * $this->duration);
                break;
            case self::FIXED:
                return 30;
                break;
            default:
                $this->costtype = self::FIXED;
                return 30;
        }
    }
    public function chargeType(): string
    {
        switch ($this->costtype) {
            case self::TIMED:
                return "Почасовая оплата";
                break;
            case self::FIXED:
                return "Фиксированная ставка";
                break;
            default:
                $this->costtype = self::FIXED;
                return "Фиксированная ставка";
        }
    }
    // Другие методы класса...
}

class Lecture extends Lesson
{
    // Реализации спицифичный для класса Lecture...
}

class Seminar extends Lesson
{
    // Реализации спицифичный для класса Seminar...
}

// применение композиции (шаблон Strategy)

abstract class Lesson2
{
    public function __construct(
        protected int $duration,
        private CostStrategy $costStrategy
    ) {
    }
    public function cost(): int
    {
        return $this->costStrategy->cost($this);
    }
    public function chargeType(): string
    {
        return $this->costStrategy->chargeType();
    }
    public function getDuration(): int
    {
        return $this->duration;
    }
    // Другие методы класса Lesson2...
}

class Lecture2 extends Lesson2
{
    // Реализации спицифичный для класса Lecture2...
}

class Seminar2 extends Lesson2
{
    // Реализации спицифичный для класса Seminar2...
}

abstract class CostStrategy
{
    abstract public function cost(Lesson2 $sellon): int;
    abstract public function chargeType(): string;
}

class TimedCostStrategy extends CostStrategy
{
    public function cost(Lesson2 $lesson): int
    {
        return ($lesson->getDuration() * 5);
    }

    public function chargeType(): string
    {
        return "Почасовая оплата";
    }
}

class FixedCostStrategy extends CostStrategy
{
    public function cost(Lesson2 $lesson): int
    {
        return 30;
    }

    public function chargeType(): string
    {
        return "Фиксированная оплата";
    }
}

// выполнение программы

echo "<pre>";
echo "----------------------------<br/>\n";
$lecture = new Lecture(5, Lesson::FIXED);
print "{$lecture->cost()} ({$lecture->chargeType()})<br>\n";
$seminar = new Seminar(3, Lesson::TIMED);
print "{$seminar->cost()} ({$seminar->chargeType()})<br>\n";
echo "----------------------------<br/>\n";
echo "----------------------------<br/>\n";
$lessons[] = new Seminar2(4, new TimedCostStrategy());
$lessons[] = new Lecture2(4, new FixedCostStrategy());
foreach ($lessons as $lesson) {
    print "Оплата за занятие {$lesson->cost()}. ";
    print " Тип оплаты: {$lesson->chargeType()}<br>\n";
}
echo "----------------------------<br/>\n";
echo "</pre>";
