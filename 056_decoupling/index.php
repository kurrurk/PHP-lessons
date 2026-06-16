<?php

$config = [
    'notifier' => 'mail',
];

$config2 = [
    'notifier' => 'sms',
];

abstract class Lesson
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

class Lecture extends Lesson
{
    // Реализации спицифичный для класса Lecture...
}

class Seminar extends Lesson
{
    // Реализации спицифичный для класса Seminar...
}

abstract class CostStrategy
{
    abstract public function cost(Lesson $lesson): int;
    abstract public function chargeType(): string;
}

class TimedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
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
    public function cost(Lesson $lesson): int
    {
        return 30;
    }

    public function chargeType(): string
    {
        return "Фиксированная оплата";
    }
}

class RegistrationMgr
{
    public function register(Lesson $lesson, array $config): void
    {
        // Некоторые действия с Lesson
        // и отправка кому-нибудь сообщения
        $notifier = Notifier::getNotifier($config['notifier']);
        $notifier->inform("new lesson: cost ({$lesson->cost()})");
    }
}

abstract class Notifier
{
    public static function getNotifier(string $type): Notifier
    {
        // Получить конкретный класс в соответствии с
        // конфигурацией или иной логикой
        return match ($type) {
            'mail' => new MailNotifier(),
            'sms' => new TextNotifier(),
            default => throw new InvalidArgumentException(
                "Неизвестный тип уведомления: {$type}"
            )
        };
    }

    abstract public function inform($message): void;
}

class MailNotifier extends Notifier
{
    public function inform($message): void
    {
        echo "----------------------------<br/>\n";
        print "Уведомление почтой: {$message}<br>\n";
        echo "----------------------------<br/>\n";
    }
}

class TextNotifier extends Notifier
{
    public function inform($message): void
    {
        echo "----------------------------<br/>\n";
        print "Уведомление текстом: {$message}<br>\n";
        echo "----------------------------<br/>\n";
    }
}

echo "<pre>";
$lessons1 = new Seminar(4, new TimedCostStrategy());
$lessons2 = new Lecture(4, new FixedCostStrategy());
$mgr = new RegistrationMgr();
$mgr->register($lessons1, $config);
$mgr->register($lessons2, $config2);
echo "</pre>";
