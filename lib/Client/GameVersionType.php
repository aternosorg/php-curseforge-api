<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;
use Aternos\CurseForgeApi\Model\GameVersionType as GameVersionTypeModel;

class GameVersionType
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        protected GameVersionTypeModel $gameVersion,
    )
    {
    }

    /**
     * @return GameVersionTypeModel
     */
    public function getData(): GameVersionTypeModel
    {
        return $this->gameVersion;
    }

    /**
     * Get all versions of this type
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getVersions(): array
    {
        return $this->client->getGameVersionsByType($this->gameVersion->getGameId(), $this->gameVersion->getId());
    }

    /**
     * Get the game of this type
     * @return Game
     * @throws ApiException
     */
    public function getGame(): Game
    {
        return $this->client->getGame($this->gameVersion->getGameId());
    }
}