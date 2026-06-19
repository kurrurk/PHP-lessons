<?php

class Preferences
{
    private array $props = [];
    private static Preferences $instance;
    private function __construct()
    {
    }
    public static function getIstance(): Preferences
    {
        if (empty(self::$instance)) {
            self::$instance = new Preferences();
        }

        return self::$instance;
    }
    public function steProperty(string $key, string $val): void
    {
        $this->props[$key] = $val;
    }
    public function getProperty(string $key): string
    {
        return $this->props[$key];
    }
}

echo "<pre>";
echo "----------------------------<br/>\n";
$pref = Preferences::getIstance();
$pref->steProperty("name", "Matt");
print "<strong>\$pref->getProperty(\"name\")</strong>:".$pref->getProperty("name")."<br/>\n";
echo "----------------------------<br/>\n";
unset($pref);
echo "удаление ссылки<br/>\n";
echo "----------------------------<br/>\n";
$pref2 = Preferences::getIstance();
print "<strong>\$pref2->getProperty(\"name\")</strong>:".$pref2->getProperty("name")."<br/>\n";
echo "----------------------------<br/>\n";
echo "</pre>";
