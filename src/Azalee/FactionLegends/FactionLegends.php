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

use Azalee\FactionLegends\Utils\ConfigUtils;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class FactionLegends extends PluginBase
{
    use SingletonTrait;
    public function onEnable(): void
    {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->saveResource("lang.yml");
        $this->saveResource("config.yml");
        ConfigUtils::getInstance()->load();
    }
}