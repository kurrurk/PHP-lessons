<?php
    declare(strict_types=1); // Отключает приведение типов. Приведение типа SimpleXMLElement к bool не работает;
    class AddressManager {
        private $addresses = ["209.131.36.159", "216.58.213.174"];
        /**
          * Вывести список адресов.
          * Если переменная $resolve содержит истинное
          * значение (true), то адрес преобразуется в
          * эквивалентное имя хоста.
          * @param $resolve Boolean Преобразовать адрес?
          */
        public function outputAddresses(bool $resolve) // bool работает даже без declare(strict_types=l);
        {
            foreach ($this->addresses as $address) {
                print $address;
                if ($resolve) {
                    print " (" . gethostbyaddr($address) . ")";
                }
                print "<br />\n";
            }
        }
    }    

    $settings = simplexml_load_file(__DIR__ . "/resolve.xml");
    $manager = new AddressManager();
    $resolve = (preg_match("/^(false|no|off)$/i", (string) $settings->resolvedomains)) ? false : true;
    $manager->outputAddresses( $resolve );
    echo "-----------------------------<br/>\n";
    $manager->outputAddresses( (bool) $settings->resolvedomains ); // "false" = true