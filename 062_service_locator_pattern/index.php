<?php

require_once "./commsManager.php";

class Settings
{
    public static string $COMMSTYPE = 'Mega';
}

class AppConfig
{
    private static ?AppConfig $instance = null;
    private CommsManager $commsManager;
    private function __construct()
    {
        // выполняется единственный раз
        $this->init();
    }
    private function init(): void
    {
        switch (Settings::$COMMSTYPE) {
            case 'Mega':
                $this->commsManager = new MegaCommsManager();
                break;
            default:
                $this->commsManager = new BloggsCommsManager();
        }
    }
    public static function getInstance(): AppConfig
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getCommsManager(): CommsManager
    {
        return $this->commsManager;
    }
}

echo "<pre>";
echo "----------------------------<br/>\n";
$commsMgr = AppConfig::getInstance()->getCommsManager();
print $commsMgr->make()->encode();
echo "----------------------------<br/>\n";
echo "</pre>";
