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
use Azalee\FactionLegends\Utils\QuerysInterface;
use pocketmine\utils\SingletonTrait;

class FactionLegendsAPI
{
    private array $factions = [];
    private array $players = [];
    private array $home = [];
    private array $lang = [];

    use SingletonTrait;

    private function LoadData(FactionLegends $plugin): void
    {
        $plugin->getDatabase()->executeSelect(QuerysInterface::FactionLegends_Faction_Load, [], function (array $row): void
        {
            foreach($row as $rows)
            {
                
            }
        });
    }
}