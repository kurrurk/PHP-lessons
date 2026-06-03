<?php

interface PresonWriter
{
    public function write(Person $person): void;
}

class Person
{
    public function output(PresonWriter $writer)
    {
        $writer->write($this);
    }
    public function getName(): string
    {
        return "Василий";
    }
    public function getAge(): int
    {
        return 39;
    }
}

$person = new Person();
$person->output(
    new class ("./tmp/persondump.txt") implements PresonWriter {
        private $path;
        public function __construct(string $path)
        {
            $this->path = $path;
        }
        public function write(Person $person): void
        {
            print $person->getName() . " " . $person->getAge() . "<br>\n";
            file_put_contents($this->path, $person->getName() . " " . $person->getAge() . "\n");
        }
    }
);
