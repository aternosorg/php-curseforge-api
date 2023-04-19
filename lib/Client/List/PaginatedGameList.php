<?php

namespace Aternos\CurseForgeApi\Client\List;

use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Model\Game as GameModel;
use Aternos\CurseForgeApi\Model\GetGamesResponse;

/**
 * Class PaginatedGameList
 *
 * @package Aternos\CurseForgeApi\Client\List
 * @description A paginated list of games
 * @extends PaginatedList<Game>
 */
class PaginatedGameList extends PaginatedList
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        GetGamesResponse $gamesResponse,
    )
    {
        parent::__construct($gamesResponse->getPagination(), array_map(function (GameModel $game) {
            return new Game($this->client, $game);
        }, $gamesResponse->getData()));
    }

    public function getOffset(int $offset): static
    {
        return $this->client->getGames($offset, $this->pagination->getPageSize());
    }
}