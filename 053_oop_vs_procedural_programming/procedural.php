<?php

function readParams(string $source): array
{
    $params = [];
    // Чтение текстовых параметров из $source
    if (!file_exists($source)) {
        return $params;
    }

    if (preg_match("/\.xml$/i", $source)) {
        $xml = simplexml_load_file($source);
        foreach ($xml->param as $param) {
            $params[(string)$param->key] = (string)$param->val;
        }
    } else {
        $lines = file($source, FILE_IGNORE_NEW_LINES);

        foreach ($lines as $line) {
            [$key, $value] = explode(':', $line, 2);
            $params[$key] = $value;
        }

    }



    return $params;
}

function writeParams(array $params, string $source): void
{
    // запись текстовых параметров в $source
    $content = '';

    if (preg_match("/\.xml$/i", $source)) {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><params></params>');
        foreach ($params as $key => $value) {
            $param = $xml->addChild('param');
            $param->addChild('key', htmlspecialchars($key));
            $param->addChild('val', htmlspecialchars($value));
        }

        $xml->asXML($source);

    } else {
        foreach ($params as $key => $value) {
            $content .= "{$key}:{$value}\n";
        }

        file_put_contents($source, $content);

    }
}

$file = "./tmp/params.txt";
$xml = "./tmp/params.xml";
$params = [
    "key1" => "val1",
    "key2" => "val2",
    "key3" => "val3",
];
writeParams($params, $file);
writeParams($params, $xml);
$output = readParams($file);


var_dump($output);
echo "<br/>----------------------------<br/>\n";
$output = readParams($xml);
var_dump($output);
