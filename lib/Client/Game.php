<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedModList;
use Aternos\CurseForgeApi\Client\Options\ModSearch\ModSearchOptions;
use Aternos\CurseForgeApi\Model\Game as GameModel;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;

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
     * Get all version types for this game
     * @return GameVersionType[]
     * @throws ApiException
     */
    public function getVersionTypes(): array
    {
        return $this->client->getGameVersionTypes($this->game->getId());
    }

    /**
     * Get all versions for each version type of this game
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getVersions(): array
    {
        return $this->client->getGameVersions($this->game->getId());
    }

    /**
     * Get all versions of a version type of this game
     * @param int $versionTypeId
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getGameVersionsByType(int $versionTypeId): array
    {
        return $this->client->getGameVersionsByType($this->game->getId(), $versionTypeId);
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

    /**
     * Search for mods
     * @param ModSearchOptions|null $options
     * @return PaginatedModList
     * @throws ApiException
     */
    public function searchMods(?ModSearchOptions $options = null): PaginatedModList
    {
        return $this->client->searchMods($options ?? new ModSearchOptions($this->game->getId()));
    }

    /**
     * Get all featured mods for this game
     * @param int[] $excludedModIds
     * @param int|null $gameVersionTypeId
     * @return FeaturedMods
     * @throws ApiException
     */
    public function getFeaturedMods(array $excludedModIds = [], ?int $gameVersionTypeId = null): FeaturedMods
    {
        return $this->client->getFeaturedMods($this->game->getId(), $excludedModIds, $gameVersionTypeId);
    }
}