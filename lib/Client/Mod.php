<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\Model\Mod as ModModel;

class Mod
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        protected ModModel            $mod,
    )
    {
    }

    /**
     * @return ModModel
     */
    public function getData(): ModModel
    {
        return $this->mod;
    }

    /**
     * @param CurseForgeAPIClient $client
     * @param ModModel[] $models
     * @return Mod[]
     */
    public static function fromModels(CurseForgeAPIClient $client, array $models): array
    {
        return array_map(fn($mod) => new Mod($client, $mod), $models);
    }
}