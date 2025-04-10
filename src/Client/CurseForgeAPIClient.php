<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\Api\CategoriesApi;
use Aternos\CurseForgeApi\Api\FilesApi;
use Aternos\CurseForgeApi\Api\FingerprintsApi;
use Aternos\CurseForgeApi\Api\GamesApi;
use Aternos\CurseForgeApi\Api\MinecraftApi;
use Aternos\CurseForgeApi\Api\ModsApi;
use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedFilesList;
use Aternos\CurseForgeApi\Client\List\PaginatedGameList;
use Aternos\CurseForgeApi\Client\List\PaginatedModList;
use Aternos\CurseForgeApi\Client\Options\ModFilesOptions;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Configuration;
use Aternos\CurseForgeApi\Model\FingerprintFuzzyMatchResult;
use Aternos\CurseForgeApi\Model\FingerprintMatchesResult;
use Aternos\CurseForgeApi\Model\FolderFingerprint;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;
use Aternos\CurseForgeApi\Model\GetFeaturedModsRequestBody;
use Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody;
use Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody;
use Aternos\CurseForgeApi\Model\GetModFilesRequestBody;
use Aternos\CurseForgeApi\Model\GetModsByIdsListRequestBody;
use Aternos\CurseForgeApi\Model\MinecraftGameVersion;
use Aternos\CurseForgeApi\Model\MinecraftModLoaderIndex;
use Aternos\CurseForgeApi\Model\MinecraftModLoaderVersion;
use Aternos\CurseForgeApi\Model\SortOrder;
use GuzzleHttp\ClientInterface;

/**
 * Class CurseForgeAPIClient
 *
 * @package Aternos\CurseForgeApi\Client
 * @description This class is the main entry point for the hangar api. It provides methods to access all hangar api endpoints.
 */
class CurseForgeAPIClient
{
    protected ?ClientInterface $httpClient;

    protected Configuration $configuration;

    protected ?string $apiToken = null;

    protected CategoriesApi $categories;

    protected FilesApi $files;

    protected FingerprintsApi $fingerprints;

    protected GamesApi $games;

    protected MinecraftApi $minecraft;

    protected ModsApi $mods;

    /**
     * CurseForgeAPIClient constructor.
     * @param string $apiToken API token used for authentication (required)
     * @param Configuration|null $configuration
     * @param ClientInterface|null $httpClient
     */
    public function __construct(string $apiToken, ?Configuration $configuration = null, ?ClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient;
        $this->configuration = $configuration ?? (Configuration::getDefaultConfiguration())
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
        $this->configuration->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_STRING);

        $this->categories = new CategoriesApi($this->httpClient, $this->configuration);
        $this->files = new FilesApi($this->httpClient, $this->configuration);
        $this->fingerprints = new FingerprintsApi($this->httpClient, $this->configuration);
        $this->games = new GamesApi($this->httpClient, $this->configuration);
        $this->minecraft = new MinecraftApi($this->httpClient, $this->configuration);
        $this->mods = new ModsApi($this->httpClient, $this->configuration);
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
     * Set the HTTP client used for all requests.
     * When null, the default HTTP client from Guzzle will be used.
     * @param ClientInterface|null $httpClient
     * @return $this
     */
    public function setHttpClient(?ClientInterface $httpClient): static
    {
        $this->httpClient = $httpClient;
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Get all games
     * @param int $offset the offset to start fetching games at
     * @param int $pageSize the number of games to fetch per page
     * @return PaginatedGameList
     * @throws ApiException
     */
    public function getGames(int $offset = 0, int $pageSize = PaginatedGameList::MAX_PAGE_SIZE): PaginatedGameList
    {
        return new PaginatedGameList($this, $this->games->getGames(
            $offset,
            PaginatedGameList::getAllowedPageSize($offset, $pageSize),
        ));
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
     * @param bool|null $classesOnly only return category classes (e.g. plugins or mods).
     * @return Category[]
     * @throws ApiException
     */
    public function getCategories(int $gameId, ?int $classId = null, ?bool $classesOnly = null): array
    {
        return array_map(fn($category) => new Category($this, $category),
            $this->categories->getCategories($gameId, $classId, $classesOnly)->getData());
    }

    /**
     * Get a category by its ID
     * @param int $gameId
     * @param int $categoryId
     * @return Category|null
     * @throws ApiException
     */
    public function getCategory(int $gameId, int $categoryId): ?Category
    {
        foreach ($this->getCategories($gameId) as $category) {
            if ($category->getData()->getId() === $categoryId) {
                return $category;
            }
        }

        return null;
    }

    /**
     * Search for mods
     * @param ModSearchOptions $options
     * @return PaginatedModList
     * @throws ApiException
     */
    public function searchMods(ModSearchOptions $options): PaginatedModList
    {
        return new PaginatedModList($this, $this->mods->searchMods(
            $options->getGameId(),
            $options->getOffset(),
            PaginatedModList::getAllowedPageSize($options->getOffset(), $options->getPageSize()),
            $options->getClassId(),
            null,
            null,
            $options->getSearchFilter(),
            $options->getSortField()?->value,
            $options->getSortOrder()?->value,
            null,
            $options->getGameVersionTypeId(),
            $options->getAuthorId(),
            $options->getSlug(),
            $options->getEncodedCategoryIds(),
            $options->getEncodedGameVersions(),
            $options->getEncodedModLoaderTypes(),
            $options->getPrimaryAuthorId(),
            $options->getPremiumType(),
        ), $options);
    }

    /**
     * Get a mod by its ID
     * @param int $modId
     * @return Mod
     * @throws ApiException
     */
    public function getMod(int $modId): Mod
    {
        return new Mod($this, $this->mods->getMod($modId)->getData());
    }

    /**
     * Fetch multiple mods at once
     * @param int[] $modIds
     * @return Mod[]
     * @throws ApiException
     */
    public function getMods(array $modIds): array
    {
        $body = (new GetModsByIdsListRequestBody())->setModIds($modIds);
        return array_map(fn($mod) => new Mod($this, $mod), $this->mods->getMods($body)->getData());
    }

    /**
     * Get all featured mods for a game
     * @param int $gameId
     * @param int[] $excludedModIds
     * @param int|null $gameVersionTypeId
     * @return FeaturedMods
     * @throws ApiException
     */
    public function getFeaturedMods(int $gameId, array $excludedModIds = [], ?int $gameVersionTypeId = null): FeaturedMods
    {
        $body = (new GetFeaturedModsRequestBody())
            ->setGameId($gameId)
            ->setExcludedModIds($excludedModIds)
            ->setGameVersionTypeId($gameVersionTypeId);

        return new FeaturedMods($this, $this->mods->getFeaturedMods($body)->getData());
    }

    /**
     * Get the description of a mod as html
     * @param int $modId
     * @return string|null
     * @throws ApiException
     */
    public function getModDescription(int $modId): ?string
    {
        return $this->mods->getModDescription($modId)->getData();
    }

    /**
     * Get a list of all files for a mod
     * @param ModFilesOptions $options
     * @return PaginatedFilesList
     * @throws ApiException
     */
    public function getModFiles(ModFilesOptions $options): PaginatedFilesList
    {
        return new PaginatedFilesList($this, $this->files->getModFiles(
            $options->getModId(),
            $options->getOffset(),
            PaginatedFilesList::getAllowedPageSize($options->getOffset(), $options->getPageSize()),
            $options->getGameVersion(),
            $options->getModLoaderType()?->value,
            $options->getGameVersionTypeId(),
            $options->getOlderThanProjectFileId(),
            $options->getReleaseTypes(),
            $options->getPlatformType()?->value,
        ), $options);
    }

    /**
     * Get a single mod file
     * @param int $modId
     * @param int $fileId
     * @return File
     * @throws ApiException
     */
    public function getModFile(int $modId, int $fileId): File
    {
        return new File($this, $this->files->getModFile($modId, $fileId)->getData());
    }

    /**
     * Fetch multiple files at once
     * @param int[] $fileIds
     * @return File[]
     * @throws ApiException
     */
    public function getFiles(array $fileIds): array
    {
        $body = (new GetModFilesRequestBody())->setFileIds($fileIds);
        return array_map(fn($file) => new File($this, $file), $this->files->getFiles($body)->getData());
    }

    /**
     * Get the changelog of a mod file as html
     * @param int $modId
     * @param int $fileId
     * @return string
     * @throws ApiException
     */
    public function getModFileChangelog(int $modId, int $fileId): string
    {
        return $this->files->getModFileChangelog($modId, $fileId)->getData();
    }

    /**
     * Get the download url of a mod file
     * @param int $modId
     * @param int $fileId
     * @return string
     * @throws ApiException
     */
    public function getModFileDownloadURL(int $modId, int $fileId): string
    {
        return $this->files->getModFileDownloadURL($modId, $fileId)->getData();
    }

    /**
     * Get files matching a list of fingerprints
     * @param int[] $fingerprints murmur2 hashes (seed: 1). Use {@see CursedFingerprintHelper} to calculate them
     * @param int|null $gameId only return files for this game
     * @return FingerprintMatchesResult
     * @throws ApiException
     */
    public function getFilesByFingerPrintMatches(array $fingerprints, ?int $gameId = null): FingerprintMatchesResult
    {
        $body = (new GetFingerprintMatchesRequestBody())->setFingerprints($fingerprints);

        if ($gameId === null) {
            return $this->fingerprints->getFingerprintMatches($body)->getData();
        }
        return $this->fingerprints->getFingerprintMatchesByGame($gameId, $body)->getData();
    }

    /**
     * Get mod files that match a list of fingerprints using fuzzy matching
     * @param FolderFingerprint[] $fingerprints murmur2 hashes (seed: 1). Use {@see CursedFingerprintHelper} to calculate them
     * @param int|null $gameId only return files for this game
     * @return FingerprintFuzzyMatchResult
     * @throws ApiException
     */
    public function getFilesByFuzzyFingerPrintMatches(array $fingerprints, ?int $gameId = null): FingerprintFuzzyMatchResult
    {
        $body = (new GetFuzzyMatchesRequestBody())->setFingerprints($fingerprints);

        if ($gameId === null) {
            return $this->fingerprints->getFingerprintFuzzyMatches($body)->getData();
        }
        return $this->fingerprints->getFingerprintFuzzyMatchesByGame($gameId, $body)->getData();
    }

    /**
     * Get a list of Minecraft versions
     * @param SortOrder $sortOrder
     * @return MinecraftGameVersion[]
     * @throws ApiException
     */
    public function getMinecraftVersions(SortOrder $sortOrder = SortOrder::ASCENDING): array
    {
        return $this->minecraft->getMinecraftVersions($sortOrder == SortOrder::DESCENDING)->getData();
    }

    /**
     * Get a specific Minecraft version
     * @param string $minecraftVersion
     * @return MinecraftGameVersion
     * @throws ApiException
     */
    public function getMinecraftVersion(string $minecraftVersion): MinecraftGameVersion
    {
        return $this->minecraft->getSpecificMinecraftVersion($minecraftVersion)->getData();
    }

    /**
     * Get Minecraft mod loaders
     * @param string|null $minecraftVersion
     * @param bool|null $includeAll
     * @return MinecraftModLoaderIndex[]
     * @throws ApiException
     */
    public function getMinecraftModLoaders(?string $minecraftVersion = null, ?bool $includeAll = null): array
    {
        return $this->minecraft->getMinecraftModLoaders($minecraftVersion, $includeAll)->getData();
    }

    /**
     * Get a specific Minecraft mod loader
     * @param string $modLoaderName
     * @return MinecraftModLoaderVersion
     * @throws ApiException
     */
    public function getMinecraftModLoader(string $modLoaderName): MinecraftModLoaderVersion
    {
        return $this->minecraft->getSpecificMinecraftModLoader($modLoaderName)->getData();
    }
}
