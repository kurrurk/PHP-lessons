<?php

abstract class ParamHandler
{
    protected array $params = [];
    public function __construct(protected string $source)
    {
    }
    public function addParam(string $key, string $val): void
    {
        $this-> params[$key] = $val;
    }
    public function getAllParams(): array
    {
        return $this->params;
    }
    public static function getInstance(string $filename): ParamHandler
    {
        if (preg_match("/\.xml$/i", $filename)) {
            return new XmlParamHandler($filename);
        }

        return new TextParamHandler($filename);
    }
    abstract public function write(): void;
    abstract public function read(): void;
}

class XmlParamHandler extends ParamHandler
{
    public function write(): void
    {
        // Запись XML
        // c спользованием $this->params;
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><params></params>');
        foreach ($this->params as $key => $value) {
            $param = $xml->addChild('param');
            $param->addChild('key', htmlspecialchars($key));
            $param->addChild('val', htmlspecialchars($value));
        }

        $xml->asXML($this->source);
    }
    public function read(): void
    {
        // Чтение XML
        // c спользованием $this->params;
        $xml = simplexml_load_file($this->source);
        foreach ($xml->param as $param) {
            $this->params[(string)$param->key] = (string)$param->val;
        }
    }
}

class TextParamHandler extends ParamHandler
{
    public function write(): void
    {
        // Запись текста
        // c спользованием $this->params;
        $content = '';
        foreach ($this->params as $key => $value) {
            $content .= "{$key}:{$value}\n";
        }

        file_put_contents($this->source, $content);
    }
    public function read(): void
    {
        // Чтение текста
        // c спользованием $this->params;
        $lines = file($this->source, FILE_IGNORE_NEW_LINES);

        foreach ($lines as $line) {
            [$key, $value] = explode(':', $line, 2);
            $this->params[$key] = $value;
        }
    }
}


$test = ParamHandler::getInstance(__DIR__ . "/tmp/oop_params.txt");
$test->addParam("key_o1", "val_o1");
$test->addParam("key_o2", "val_o2");
$test->addParam("key_o3", "val_o3");
$test->write();
$test->read();

$params = $test->getAllParams();
var_dump($params);
echo "<br/>----------------------------<br/>\n";
$test2 = ParamHandler::getInstance(__DIR__ . "/tmp/oop_params.xml");
$test2->addParam("key_o1", "val_o1");
$test2->addParam("key_o2", "val_o2");
$test2->addParam("key_o3", "val_o3");
$test2->write();
$test2->read();

$params = $test2->getAllParams();
var_dump($params);
echo "<br/>----------------------------<br/>\n";
