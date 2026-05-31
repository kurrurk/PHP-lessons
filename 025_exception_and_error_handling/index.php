<?php

class Conf
{
    private \SimpleXMLElement $xml;
    private \SimpleXMLElement $lastmatch;

    public function __construct(private string $file)
    {
        if (!file_exists($file)) {
            throw new \Exception("Файл '{$file}' не найден или не существует");
        }
        $this->xml = simplexml_load_file($file);
    }

    public function write(): void
    {
        if (!is_writable($this->file)) {
            throw new \Exception("Файл '{$this->file}' не найден или не существует");
        }
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get(string $str): ?string
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastmatch = $matches[0];
            return (string)$matches[0];
        }
        return null;
    }

    public function set(string $key, string $value): void
    {
        if (! is_null($this->get($key))) {
            $this->lastmatch[0] = $value;
            return;
        }

        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)
            ->addAttribute('name', $key);
    }
}

try {
    $config = new Conf(__DIR__ . "/resolve.xml");
    //$config_error1 = new Conf(__DIR__ . "/unwriteable.xml");

    echo "user: " . $config->get('user') . "<br>";
    echo '<em>$config->set("user", "john");</em><br>';
    $config->set('user', 'john');
    $config->set('secondname', 'smith');
    echo "user: " . $config->get('user') . "<br>";
    echo "-----------------------------<br/>\n";
    echo "<pre>";
    var_dump($config);
    echo "</pre>";

    $config->write();
} catch (\Exception $e) {
    // Обработка ошибки тем или иным способом
    // или
    throw new \Exception("Ошибка конфигурации " . $e->getMessage());
}

try {
    $config_error1 = new Conf(__DIR__ . "/unwriteable.xml");
    $config_error1->write();
} catch (\Exception) {
    echo "<strong>Line 81</strong>: Обработка ошибки без применения объекта Exaption<br>";
}

try {
    $config_error2 = new Conf(__DIR__ . "/not_here.xml");
} catch (\Exception $e) {
    // Обработка ошибки тем или иным способом
    // или повторная генерация того же исключения - таким образом в сообщении об ошибке будет указана строка на которой она была вызвана
    throw $e;
}
