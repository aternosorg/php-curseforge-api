<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\Api\CategoriesApi;
use Aternos\CurseForgeApi\Api\FilesApi;
use Aternos\CurseForgeApi\Api\FingerprintsApi;
use Aternos\CurseForgeApi\Api\GamesApi;
use Aternos\CurseForgeApi\Api\MinecraftApi;
use Aternos\CurseForgeApi\Api\ModsApi;
use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedGameList;
use Aternos\CurseForgeApi\Configuration;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;

/**
 * Class HangarAPIClient
 *
 * @package Aternos\HangarApi\Client
 * @description This class is the main entry point for the hangar api. It provides methods to access all hangar api endpoints.
 */
class CurseForgeAPIClient
{

    protected Configuration $configuration;

    protected ?string $apiToken = null;

    protected CategoriesApi $categories;

    protected FilesApi $files;

    protected FingerprintsApi $fingerprints;

    protected GamesApi $games;

    protected MinecraftApi $minecraft;

    protected ModsApi $mods;

    /**
     * HangarAPIClient constructor.
     * @param string $apiToken API token used for authentication (required)
     * @param Configuration|null $configuration
     */
    public function __construct(string $apiToken, ?Configuration $configuration = null)
    {
        $this->configuration = $configuration ?? (new Configuration())
            ->setUserAgent("php-curseforge-api/1.0.0");
        $this->setApiToken($apiToken);
    }

    /**
     * @param Configuration $configuration
     * @return $this
     */
    public function setConfiguration(Configuration $configuration): static
    {
        $this->configuration = $configuration;
        $this->categories = new CategoriesApi(null, $this->configuration);
        $this->files = new FilesApi(null, $this->configuration);
        $this->fingerprints = new FingerprintsApi(null, $this->configuration);
        $this->games = new GamesApi(null, $this->configuration);
        $this->minecraft = new MinecraftApi(null, $this->configuration);
        $this->mods = new ModsApi(null, $this->configuration);
        return $this;
    }

    /**
     * Set the user agent used for HTTP requests
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent): static
    {
        $this->configuration->setUserAgent($userAgent);
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Set the API token used for authentication.
     * This is required to access all endpoints.
     * @param string|null $apiKey
     * @return $this
     */
    public function setApiToken(?string $apiKey): static
    {
        $this->apiToken = $apiKey;
        $this->configuration->setApiKey("x-api-key", $apiKey);
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Get all games
     * @param int $offset the offset to start fetching games at
     * @param int $pageSize the number of games to fetch per page
     * @return PaginatedGameList
     * @throws ApiException
     */
    public function getGames(int $offset = 0, int $pageSize = 50): PaginatedGameList
    {
        return new PaginatedGameList($this, $this->games->getGames($offset, $pageSize));
    }

    /**
     * Get a game by its ID
     * @param int $gameId
     * @return Game
     * @throws ApiException
     */
    public function getGame(int $gameId): Game
    {
        return new Game($this, $this->games->getGame($gameId)->getData());
    }

    /**
     * Get all version types for a game
     * @param int $gameId
     * @return GameVersionType[]
     * @throws ApiException
     */
    public function getGameVersionTypes(int $gameId): array
    {
        return array_map(fn($versionType) => new GameVersionType($this, $versionType),
            $this->games->getVersionTypes($gameId)->getData());
    }

    /**
     * Get all versions for each version type of the specified game
     * @param int $gameId
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getGameVersions(int $gameId): array
    {
        return $this->games->getVersionsV2($gameId)->getData();
    }

    /**
     * Get all versions of a version type and game
     * @param int $gameId
     * @param int $versionTypeId
     * @return GameVersionsByTypeV2[]
     * @throws ApiException
     */
    public function getGameVersionsByType(int $gameId, int $versionTypeId): array
    {
        $versions = $this->getGameVersions($gameId);

        foreach ($versions as $version) {
            if ($version->getType() === $versionTypeId) {
                return $version->getVersions();
            }
        }

        return [];
    }

    /**
     * Get all categories and category classes for a game
     * @param int $gameId The ID of the game you want to query categories for (e.g. 432 for Minecraft)
     * @param int|null $classId The ID of the category class you want to query categories for (e.g. 5 for plugins or 6 for mods)
     * @param bool|null $classesOnly only return category classes (e.g. plugins or mods). This option appears to be ignored right now. TODO: create ticket
     * @return Category[]
     * @throws ApiException
     */
    public function getCategories(int $gameId, ?int $classId = null, ?bool $classesOnly = null): array
    {
        return array_map(fn($category) => new Category($this, $category),
            $this->categories->getCategories($gameId, $classId, $classesOnly)->getData());
    }
}