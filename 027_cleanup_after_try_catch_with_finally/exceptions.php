<?php

class XmlException extends \Exception
{
    public function __construct(private \LibXMLError $error)
    {
        $shortfile = basename($error->file);
        $msg = "[{$shortfile}, line {$error->line}, col {$error->column}] {$error->message}";
        $this->error = $error;
        parent::__construct($msg, $error->code);
    }
    public function getLibXmlError(): \LibXMLError
    {
        return $this->error;
    }
}

class FileException extends \Exception
{
}

class ConfException extends \Exception
{
}
