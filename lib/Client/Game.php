<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Model\Game as GameModel;

class Game
{

    /**
     * @param CurseForgeAPIClient $client
     * @param GameModel $game
     */
    public function __construct(
        protected CurseForgeAPIClient $client,
        protected GameModel $game
    )
    {
    }

    /**
     * @param int|null $classId The ID of the category class you want to query categories for (e.g. 5 for plugins or 6 for mods)
     * @param bool|null $classesOnly only return category classes (e.g. plugins or mods). This option appears to be ignored right now. TODO: create ticket
     * @return array
     * @throws ApiException
     */
    public function getCategories(?int $classId = null, ?bool $classesOnly = null): array
    {
        return $this->client->getCategories($this->game->getId(), $classId, $classesOnly);
    }
}