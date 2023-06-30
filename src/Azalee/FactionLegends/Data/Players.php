<?php

namespace Azalee\FactionLegends\Data;

class Players
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

    public function getFaction(): string
    {
        return $this->data["faction"];
    }

    public function getRole(): string
    {
        return $this->data["role"];
    }
}