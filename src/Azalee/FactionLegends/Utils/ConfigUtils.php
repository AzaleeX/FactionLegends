<?php

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