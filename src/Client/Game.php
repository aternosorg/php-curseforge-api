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
     * Fetch all version types for this game
     * This sends a request to the CurseForge API every time it is called.
     * @return GameVersionType[]
     * @throws ApiException
     */
    public function fetchVersionTypes(): array
    {
        return $this->client->getGameVersionTypes($this->getId());
    }

    /**
     * Fetch all versions for each version type of this game
     * This sends a request to the CurseForge API every time it is called.
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function fetchVersions(): array
    {
        return $this->client->getGameVersions($this->getId());
    }

    /**
     * Fetch all versions of a version type of this game
     * This sends a request to the CurseForge API every time it is called.
     * @param int $versionTypeId
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function fetchGameVersionsByType(int $versionTypeId): array
    {
        return $this->client->getGameVersionsByType($this->getId(), $versionTypeId);
    }

    /**
     * Fetch the categories of this game
     * This sends a request to the CurseForge API every time it is called.
     * @param int|null $classId The ID of the category class you want to query categories for (e.g. 5 for plugins or 6 for mods)
     * @param bool|null $classesOnly only return category classes (e.g. plugins or mods).
     * @return array
     * @throws ApiException
     */
    public function fetchCategories(?int $classId = null, ?bool $classesOnly = null): array
    {
        return $this->client->getCategories($this->getId(), $classId, $classesOnly);
    }

    /**
     * Search for mods in this game
     * This sends a request to the CurseForge API every time it is called.
     * @param ModSearchOptions|null $options
     * @return PaginatedModList
     * @throws ApiException
     */
    public function searchMods(?ModSearchOptions $options = null): PaginatedModList
    {
        return $this->client->searchMods($options ?? new ModSearchOptions($this->getId()));
    }

    /**
     * Fetch all featured mods for this game
     * This sends a request to the CurseForge API every time it is called.
     * @param int[] $excludedModIds
     * @param int|null $gameVersionTypeId
     * @param bool|null $clientCompatible
     * @return FeaturedMods
     * @throws ApiException
     */
    public function fetchFeaturedMods(array $excludedModIds = [], ?int $gameVersionTypeId = null, ?bool $clientCompatible = null): FeaturedMods
    {
        return $this->client->getFeaturedMods($this->getId(), $excludedModIds, $gameVersionTypeId, $clientCompatible);
    }
}
