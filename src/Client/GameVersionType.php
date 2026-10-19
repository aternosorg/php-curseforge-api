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
     * @deprecated The game version type extends the generated model now, so its getters can be used directly.
     * @return GameVersionTypeModel
     */
    public function getData(): GameVersionTypeModel
    {
        return $this;
    }

    /**
     * Get all versions of this type
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getVersions(): array
    {
        return $this->client->getGameVersionsByType($this->getGameId(), $this->getId());
    }

    /**
     * Get the game of this type
     * @return Game
     * @throws ApiException
     */
    public function getGame(): Game
    {
        return $this->client->getGame($this->getGameId());
    }
}