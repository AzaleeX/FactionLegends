<?php

/***
 *   _____          _   _             _                              _
 *  |  ___|_ _  ___| |_(_) ___  _ __ | |    ___  __ _  ___ _ __   __| |___
 *  | |_ / _` |/ __| __| |/ _ \| '_ \| |   / _ \/ _` |/ _ \ '_ \ / _` / __|
 *  |  _| (_| | (__| |_| | (_) | | | | |__|  __/ (_| |  __/ | | | (_| \__ \
 *  |_|  \__,_|\___|\__|_|\___/|_| |_|_____\___|\__, |\___|_| |_|\__,_|___/
 *                                              |___/
 * @author AzaleeX
 * @link https://github.com/AzaleeX
 */

namespace Azalee\FactionLegends;

use Azalee\FactionLegends\API\FactionLegendsAPI;
use Azalee\FactionLegends\Manager\LanguageManager;
use Azalee\FactionLegends\Utils\ConfigUtils;
use Azalee\FactionLegends\Utils\QuerysInterface;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class FactionLegends extends PluginBase
{
    use SingletonTrait;

    private ?DataConnector $database = null;
    private ?LanguageManager $lang = null;

    public function onEnable(): void
    {
        $virion = $this->getServer()->getPluginManager()->getPlugin('DEVirion');
        if (!$virion)
        {
            $this->getLogger()->error("DEVirion was not found. Download DEVirion at https://github.com/poggit/devirion/tree/pm5.");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->saveResource("lang.yml");
        $this->saveResource("config.yml");
        ConfigUtils::getInstance()->load();
        $this->dataInit();
        FactionLegendsAPI::getInstance()->loadData($this);
        $this->lang = new LanguageManager($this);
    }

    public function onDisable(): void
    {
        if ($this->database) {
            $this->database->waitAll();
            $this->database->close();
        }
    }

    private function dataInit(): void
    {
        $this->database = libasynql::create($this, $this->getConfig()->get("DATABASE-TYPE"), [
            "sqlite" => "sqlite.sql",
            "mysql" => "mysql.sql"
        ]);
        $this->database->executeGeneric(QuerysInterface::FactionLegends_Faction_Init);
        $this->database->executeGeneric(QuerysInterface::FactionLegends_Player_Init);
        $this->database->executeGeneric(QuerysInterface::FactionLegends_Home_Init);
        $this->database->executeGeneric(QuerysInterface::FactionLegends_Lang_Init);
    }

    public function getDatabase(): ?DataConnector
    {
        return $this->database;
    }

    public function getLang(): ?LanguageManager
    {
        return $this->lang;
    }
}