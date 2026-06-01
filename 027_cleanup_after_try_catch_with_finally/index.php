<?php

require_once "./exceptions.php";

class Conf
{
    private \SimpleXMLElement | false $xml; // false добавлено потому что при ошибке simplexml_load_file() возращает это занчение и приводит к ошибке несоответствия типов
    private \SimpleXMLElement $lastmatch;

    public function __construct(private string $file)
    {
        if (!file_exists($file)) {
            throw new FileException("Файл '{$file}' не существует");
        }

        $this->xml = simplexml_load_file($file, null, LIBXML_NOERROR); // LIBXML_NOERROR это флаг блокирующий выдачу предупреждений и дающий свободу действий для их последующей обработки в классе XmlException

        if (!is_object($this->xml)) {
            throw new XmlException(libxml_get_last_error());
        }

        $matches = $this->xml->xpath("/conf");
        if (!count($matches)) {
            throw new ConfException("Не найден корневой элемент");
        }
    }

    public function write(): void
    {
        if (!is_writable($this->file)) {
            throw new FileException("Нельзя писать в '{$this->file}'");
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

class Runner
{
    public static function init(string $file_name, string $log_file): void
    {
        try {
            $fh = fopen($log_file, "a");
            fputs($fh, "Начало\n");
            $config = new Conf($file_name);
            echo "-----------------------------<br/>\n";
            echo "user: " . $config->get('user') . "<br>";
            echo "host: " . $config->get('host') . "<br>";
            echo "-----------------------------<br/>\n";
            echo "<pre>";
            var_dump($config);
            echo "</pre>";
            echo "-----------------------------<br/>\n";
            $config->set("pass", "qwertz");
            $config->write();

        } catch (FileException $e) {
            echo "Файл не существует или не доступен для записи<br>";
            fputs($fh, "Проблема с файлом\n");
        } catch (XmlException $e) {
            echo "Поврежденный xml<br>";
            fputs($fh, "Проблема с xml\n");
        } catch (ConfException $e) {
            echo "Неверный формат XML-файла<br>";
            fputs($fh, "Проблема конфигурации\n");
        } catch (\Exception $e) {
            // Ловушка: этот код не должен вызываться
            fputs($fh, "Непредвиденные проблемы\n");
        } catch (\Throwable $e) { // добавлено чтобы отлавливать случайные ошибки TypeError и т.п.
            echo get_class($e). "<br>";
            fputs($fh, "Совсем непредвиденные проблемы\n");
        } finally {
            fputs($fh, "Конец\n");
            fclose($fh);
        }
    }
}

echo "new Runner()->init(__DIR__ . \"/resolve.xml\"):<br>";
new Runner()->init(__DIR__ . "/resolve.xml", __DIR__ . "/logs/log.txt");
echo "new Runner()->init(__DIR__ . \"/not_here.xml\"):<br>";
new Runner()->init(__DIR__ . "/not_here.xml", __DIR__ . "/logs/file_error.txt");
echo "-----------------------------<br/>\n";
echo "new Runner()->init(__DIR__ . \"/unwriteable.xml\"):<br>";
new Runner()->init(__DIR__ . "/unwriteable.xml", __DIR__ . "/logs/file_error.txt");
echo "-----------------------------<br/>\n";
echo "new Runner()->init(__DIR__ . \"/no_conf.xml\"):<br>";
new Runner()->init(__DIR__ . "/no_conf.xml", __DIR__ . "/logs/conf_error.txt");
echo "-----------------------------<br/>\n";
echo "new Runner()->init(__DIR__ . \"/error.xml\"):<br>";
new Runner()->init(__DIR__ . "/error.xml", __DIR__ . "/logs/xml_error.txt");
echo "-----------------------------<br/>\n";
