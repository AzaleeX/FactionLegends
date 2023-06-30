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
 * @contributor Aslak
 *
 * use Wiki for use FactionLegendsAPI on https://github.com/AzaleeX/FactionLegends/wiki
 *
 */

namespace Azalee\FactionLegends\API;

use Azalee\FactionLegends\Data\Faction;
use Azalee\FactionLegends\Data\Players;
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
        $plugin->getDatabase()->executeSelect(QuerysInterface::FactionLegends_LoadData, [], function (array $rows): void {
            foreach ($rows as $row) {
                switch ($row["type"]) {
                    case "faction":
                        $this->factions[$row["name"]] = new Faction($row);
                        break;
                    case "player":
                        $this->players[$row["name"]] = new Players($row);
                        break;
                    case "home":
                        $this->home[$row["name"]] = $row;
                        break;
                    case "lang":
                        $this->lang[$row["name"]] = $row["lang"];
                        break;
                }
            }
        });
    }

    public function existFaction(string $name): bool
    {
        return isset($this->factions[$name]);
    }

    public function existPlayer(string $name): bool
    {
        return isset($this->players[$name]);
    }

    public function getFactionsData(): array
    {
        return array_values($this->factions);
    }

    public function getFaction(string $name): ?Faction
    {
        return $this->factions[$name] ?? null;
    }

    public function getPlayer(string $name): ?Players
    {
        return $this->players[$name] ?? null;
    }

    public function createFaction(string $name, Player $creator): void
    {
        if (!$this->existFaction($name)) {
            $factionData = [
                "name" => $name,
                "description" => FactionLegends::getInstance()->getLang()->getMessage("NO_DESCRPTION"),
                "status" => "invited",
                "players" => [$creator->getName()],
                "power" => 0,
                "money" => 0,
                "allies" => [],
                "claims" => []
            ];

            $faction = new Faction($factionData);
            $this->factions[$name] = $faction;

            $playerData = [
                "name" => $creator->getName(),
                "faction" => $name,
                "role" => "leader"
            ];

            $player = new Players($playerData);
            $this->players[$creator->getName()] = $player;
        } else {
            throw new \RuntimeException("Faction already exists");
        }
    }
}
