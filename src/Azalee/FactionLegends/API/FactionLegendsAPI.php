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
 *
 * use Wiki for use FactionLegendsAPI on https://github.com/AzaleeX/FactionLegends/wiki
 *
 */

namespace Azalee\FactionLegends\API;

use Azalee\FactionLegends\FactionLegends;
use Azalee\FactionLegends\Manager\LanguageManager;
use Azalee\FactionLegends\Utils\QuerysInterface;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;

class FactionLegendsAPI
{
    private array $factions = [];
    private array $players = [];
    private array $home = [];
    private array $lang = [];
    use SingletonTrait;

    public function loadData(FactionLegends $plugin): void
    {
        $plugin->getDatabase()->executeSelect(QuerysInterface::FactionLegends_Faction_Load, [], function (array $row): void
        {
            foreach($row as $rows)
            {
                $this->factions =
                    [
                        "name" => $rows["name"],
                        "description" => $rows["description"],
                        "status" => $rows["status"],
                        "players" => $rows["players"],
                        "power" => $rows["power"],
                        "money" => $rows["money"],
                        "allies" => $rows["allies"],
                        "claims" => $rows["claims"]
                    ];
            }
        });
        $plugin->getDatabase()->executeSelect(QuerysInterface::FactionLegends_Player_Load, [], function (array $row): void
        {
            foreach($row as $rows)
            {
                $this->players =
                    [
                        "name" => $rows["name"],
                        "faction" => $rows["faction"],
                        "role" => $rows["role"]
                    ];
            }
        });
        $plugin->getDatabase()->executeSelect(QuerysInterface::FactionLegends_Home_Load, [], function (array $row): void
        {
            foreach($row as $rows)
            {
                $this->home =
                    [
                        "name" => $rows["name"],
                        "faction" => $rows["faction"],
                        "x" => $rows["x"],
                        "y" => $rows["y"],
                        "z" => $rows["z"],
                        "world" => $rows["world"]
                    ];
            }
        });
        $plugin->getDatabase()->executeSelect(QuerysInterface::FactionLegends_Lang_Load, [], function (array $row): void
        {
            foreach($row as $rows)
            {
                $this->lang =
                    [
                        "name" => $rows["name"],
                        "lang" => $rows["lang"]
                    ];
            }
        });
    }

    public function existFaction(string $name): bool
    {
        return array_key_exists($name, $this->factions);
    }

    public function createFaction(string $name, Player $creater): void
    {
        if(!$this->existFaction($name))
        {
            $this->factions[$name] = [
                "name" => $name,
                "description" => FactionLegends::getInstance()->getLang()->getMessage("NO_DESCRPTION"),
                "status" => "invited",
                "players" => [$creater->getName()],
                "power" => 0,
                "money" => 0,
                "allies" => [],
                "claims" => []
            ];
            $this->players[$creater->getName()] = [
                "name" => $creater->getName(),
                "faction" => $name,
                "role" => "leader"
            ];
        }else{
            $creater->sendMessage(FactionLegends::getInstance()->getLang()->getMessage("EXISTING_FACTION"));
        }
    }
}