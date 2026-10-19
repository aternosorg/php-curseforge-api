<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;
use Aternos\CurseForgeApi\Model\GameVersionType as GameVersionTypeModel;

class GameVersionType extends GameVersionTypeModel
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        GameVersionTypeModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Fetch all versions of this type
     * This sends a request to the CurseForge API every time it is called.
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function fetchVersions(): array
    {
        return $this->client->getGameVersionsByType($this->getGameId(), $this->getId());
    }

    /**
     * Fetch the game of this type
     * This sends a request to the CurseForge API every time it is called.
     * @return Game
     * @throws ApiException
     */
    public function fetchGame(): Game
    {
        return $this->client->getGame($this->getGameId());
    }
}