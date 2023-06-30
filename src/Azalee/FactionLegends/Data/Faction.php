<?php

namespace Azalee\FactionLegends\Data;

class Faction
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getName(): string
    {
        return $this->data["name"];
    }

    public function getDescription(): string
    {
        return $this->data["description"];
    }

    public function getStatus(): string
    {
        return $this->data["status"];
    }

    public function getPlayers(): array
    {
        return $this->data["players"];
    }

    public function getPower(): int
    {
        return $this->data["power"];
    }

    public function getMoney(): int
    {
        return $this->data["money"];
    }

    public function getAllies(): array
    {
        return $this->data["allies"];
    }

    public function getClaims(): array
    {
        return $this->data["claims"];
    }
}