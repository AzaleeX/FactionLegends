<?php

namespace Azalee\FactionLegends\Manager;

use Azalee\FactionLegends\FactionLegends;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class LanguageManager
{
    const Languages = [
        "FR",
        "en-US",
    ];

    public function __construct(FactionLegends $plugin)
    {
        $langchoose = $plugin->getConfig()->get("language");
        $plugin->getLogger()->warning("The lauguage you've selected is {$langchoose}, if it's wrong, change it in config.yml");
        foreach (self::Languages as $language)
        {
            $plugin->saveResource("lang/{$language}.yml");
        }
    }

    public function getMessage(string $message, array $parameters = []): string
    {
        $langchoose = FactionLegends::getInstance()->getConfig()->get("language");
        $config = new Config("lang/{$langchoose}.yml", Config::YAML);
        $message = $config->get($message);
        $message = str_replace(array_keys($parameters), $parameters, $message);
        return $message;
    }
}