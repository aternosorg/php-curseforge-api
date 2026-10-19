<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedModList;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Model\Game as GameModel;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;

class Game extends GameModel
{

    /**
     * @param CurseForgeAPIClient $client
     * @param GameModel $data
     */
    public function __construct(
        protected CurseForgeAPIClient $client,
        GameModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Get all version types for this game
     * @return GameVersionType[]
     * @throws ApiException
     */
    public function getVersionTypes(): array
    {
        return $this->client->getGameVersionTypes($this->getId());
    }

    /**
     * Get all versions for each version type of this game
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getVersions(): array
    {
        return $this->client->getGameVersions($this->getId());
    }

    /**
     * Get all versions of a version type of this game
     * @param int $versionTypeId
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getGameVersionsByType(int $versionTypeId): array
    {
        return $this->client->getGameVersionsByType($this->getId(), $versionTypeId);
    }

    /**
     * @param int|null $classId The ID of the category class you want to query categories for (e.g. 5 for plugins or 6 for mods)
     * @param bool|null $classesOnly only return category classes (e.g. plugins or mods).
     * @return array
     * @throws ApiException
     */
    public function getCategories(?int $classId = null, ?bool $classesOnly = null): array
    {
        return $this->client->getCategories($this->getId(), $classId, $classesOnly);
    }

    /**
     * Search for mods
     * @param ModSearchOptions|null $options
     * @return PaginatedModList
     * @throws ApiException
     */
    public function searchMods(?ModSearchOptions $options = null): PaginatedModList
    {
        return $this->client->searchMods($options ?? new ModSearchOptions($this->getId()));
    }

    /**
     * Get all featured mods for this game
     * @param int[] $excludedModIds
     * @param int|null $gameVersionTypeId
     * @param bool|null $clientCompatible
     * @return FeaturedMods
     * @throws ApiException
     */
    public function getFeaturedMods(array $excludedModIds = [], ?int $gameVersionTypeId = null, ?bool $clientCompatible = null): FeaturedMods
    {
        return $this->client->getFeaturedMods($this->getId(), $excludedModIds, $gameVersionTypeId, $clientCompatible);
    }
}
