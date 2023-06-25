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

namespace Azalee\FactionLegends\Utils;

use Azalee\FactionLegends\FactionLegends;
use pocketmine\utils\SingletonTrait;

class ConfigUtils
{
    use SingletonTrait;
    private array $config;

    public function load(): void
    {
        $this->config = FactionLegends::getInstance()->getConfig()->getAll();
    }

    public function getInfoConfig(string $value): mixed
    {
        return $this->config[$value];
    }
}