<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
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
     * @param CurseForgeAPIClient $client
     * @param ModModel[] $models
     * @return Mod[]
     */
    public static function fromModels(CurseForgeAPIClient $client, array $models): array
    {
        return array_map(fn($mod) => new Mod($client, $mod), $models);
    }

    /**
     * @return ModModel
     */
    public function getData(): ModModel
    {
        return $this->mod;
    }

    /**
     * Fetch the description of this mod as html
     * @return string|null
     * @throws ApiException
     */
    public function getDescription(): ?string
    {
        return $this->client->getModDescription($this->mod->getId());
    }
}