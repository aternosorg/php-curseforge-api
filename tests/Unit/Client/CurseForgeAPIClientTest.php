<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Category;
use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use Aternos\CurseForgeApi\Client\File;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Client\GameVersionType;
use Aternos\CurseForgeApi\Client\Mod;
use Aternos\CurseForgeApi\Client\Options\ModFilesOptions;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Configuration;
use Aternos\CurseForgeApi\Model\Category as CategoryModel;
use Aternos\CurseForgeApi\Model\File as FileModel;
use Aternos\CurseForgeApi\Model\FileReleaseType;
use Aternos\CurseForgeApi\Model\Game as GameModel;
use Aternos\CurseForgeApi\Model\GameVersion;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;
use Aternos\CurseForgeApi\Model\GameVersionType as GameVersionTypeModel;
use Aternos\CurseForgeApi\Model\Mod as ModModel;
use Aternos\CurseForgeApi\Model\ModLoaderType;
use Aternos\CurseForgeApi\Model\ModSearchSortField;
use Aternos\CurseForgeApi\Model\PlatformType;
use Aternos\CurseForgeApi\Model\PremiumType;
use Aternos\CurseForgeApi\Model\SortOrder;
use Composer\InstalledVersions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

class CurseForgeAPIClientTest extends ClientTestCase
{
    /**
     * @throws ApiException
     */
    public function testApiTokenIsSentWithRequests(): void
    {
        $client = $this->createClient([new Response(200, [], '{"data": {"id": 432}}')]);

        $client->getGame(432);

        $this->assertGetRequest("/v1/games/432");
        $this->assertSame(static::API_TOKEN, $this->getRequest()->getHeaderLine("x-api-key"));
    }

    /**
     * @throws ApiException
     */
    public function testSetApiTokenReplacesApiToken(): void
    {
        $client = $this->createClient([new Response(200, [], '{"data": {"id": 432}}')]);

        $this->assertSame($client, $client->setApiToken("other-api-token"));
        $client->getGame(432);

        $this->assertSame("other-api-token", $this->getRequest()->getHeaderLine("x-api-key"));
    }

    /**
     * @throws ApiException
     */
    public function testSetApiTokenToNullRemovesApiToken(): void
    {
        $client = $this->createClient([new Response(200, [], '{"data": {"id": 432}}')]);

        $client->setApiToken(null);
        $client->getGame(432);

        $this->assertFalse($this->getRequest()->hasHeader("x-api-key"));
    }

    public function testGetLibraryVersionReturnsInstalledVersion(): void
    {
        $this->assertSame(
            InstalledVersions::getPrettyVersion(CurseForgeAPIClient::PACKAGE_NAME),
            CurseForgeAPIClient::getLibraryVersion()
        );
        $this->assertNotSame("unknown", CurseForgeAPIClient::getLibraryVersion());
    }

    public function testDefaultUserAgentContainsPackageAndVersion(): void
    {
        $this->assertSame(
            "aternos/php-curseforge-api/" . CurseForgeAPIClient::getLibraryVersion(),
            CurseForgeAPIClient::getDefaultUserAgent()
        );
    }

    /**
     * @throws ApiException
     */
    public function testDefaultUserAgentIsSentWithRequests(): void
    {
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{"data": {"id": 432}}')]));
        $stack->push(Middleware::history($this->requests));
        $client = new CurseForgeAPIClient(static::API_TOKEN, null, new Client(['handler' => $stack]));

        $client->getGame(432);

        $this->assertSame(CurseForgeAPIClient::getDefaultUserAgent(), $this->getRequest()->getHeaderLine("User-Agent"));
    }

    /**
     * @throws ApiException
     */
    public function testSetUserAgentIsSentWithRequests(): void
    {
        $client = $this->createClient([new Response(200, [], '{"data": {"id": 432}}')]);

        $this->assertSame($client, $client->setUserAgent("test-agent/1.0"));
        $client->getGame(432);

        $this->assertSame("test-agent/1.0", $this->getRequest()->getHeaderLine("User-Agent"));
    }

    /**
     * @throws ApiException
     */
    public function testSetHttpClientReplacesHttpClient(): void
    {
        $client = $this->createClient();
        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{"data": {"id": 432}}')]));
        $stack->push(Middleware::history($history));

        $this->assertSame($client, $client->setHttpClient(new Client(['handler' => $stack])));
        $client->getGame(432);

        $this->assertCount(1, $history);
        $this->assertRequestCount(0);
    }

    /**
     * Clients created without an explicit configuration must not share one,
     * otherwise setting the API token or user agent of one client would change it for all others.
     *
     * @throws ApiException
     */
    public function testClientsWithoutExplicitConfigurationDoNotShareOne(): void
    {
        $defaultConfiguration = Configuration::getDefaultConfiguration();
        $defaultApiKey = $defaultConfiguration->getApiKey("x-api-key");
        $defaultUserAgent = $defaultConfiguration->getUserAgent();

        $firstHistory = [];
        $secondHistory = [];
        $first = new CurseForgeAPIClient("first-api-token", null, $this->createHttpClient($firstHistory));
        $second = new CurseForgeAPIClient("second-api-token", null, $this->createHttpClient($secondHistory));
        $first->setUserAgent("first-agent/1.0");

        $first->getGame(432);
        $second->getGame(432);

        $this->assertSame("first-api-token", $firstHistory[0]['request']->getHeaderLine("x-api-key"));
        $this->assertSame("first-agent/1.0", $firstHistory[0]['request']->getHeaderLine("User-Agent"));
        $this->assertSame("second-api-token", $secondHistory[0]['request']->getHeaderLine("x-api-key"));
        $this->assertSame(CurseForgeAPIClient::getDefaultUserAgent(), $secondHistory[0]['request']->getHeaderLine("User-Agent"));
        $this->assertSame($defaultApiKey, $defaultConfiguration->getApiKey("x-api-key"));
        $this->assertSame($defaultUserAgent, $defaultConfiguration->getUserAgent());
    }

    /**
     * @throws ApiException
     */
    public function testExplicitConfigurationIsUsed(): void
    {
        $history = [];
        $configuration = new Configuration();
        $client = new CurseForgeAPIClient(static::API_TOKEN, $configuration, $this->createHttpClient($history));

        $client->setUserAgent("custom-agent/1.0");
        $client->getGame(432);

        $this->assertSame(static::API_TOKEN, $configuration->getApiKey("x-api-key"));
        $this->assertSame("custom-agent/1.0", $configuration->getUserAgent());
        $this->assertSame("custom-agent/1.0", $history[0]['request']->getHeaderLine("User-Agent"));
    }

    /**
     * ObjectSerializer reads the boolean format from the default configuration,
     * so boolean query parameters must also be sent as strings if the client uses its own configuration.
     *
     * @throws ApiException
     */
    public function testBooleanQueryParametersAreSentAsStrings(): void
    {
        Configuration::getDefaultConfiguration()->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_INT);
        $client = $this->createClient([new Response(200, [], '{"data": []}')]);

        $client->getCategories(432, null, true);

        $this->assertGetRequest("/v1/categories", ["gameId" => "432", "classesOnly" => "true"]);
    }

    /**
     * @throws ApiException
     */
    public function testGetGames(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGames.json"))]);

        $games = $client->getGames();

        $this->assertGetRequest("/v1/games", ["index" => "0", "pageSize" => "50"]);
        $this->assertCount(2, $games);
        $this->assertContainsOnlyInstancesOf(Game::class, $games->getResults());
        $this->assertSame("final-fantasy-v", $games[0]->getSlug());
    }

    /**
     * @throws ApiException
     */
    public function testGetGamesWithOffsetAndPageSize(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGames.json"))]);

        $client->getGames(10, 2);

        $this->assertGetRequest("/v1/games", ["index" => "10", "pageSize" => "2"]);
    }

    /**
     * @throws ApiException
     */
    public function testGetGame(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGame.json"))]);

        $game = $client->getGame(432);

        $this->assertGetRequest("/v1/games/432");
        $this->assertInstanceOf(GameModel::class, $game);
        $this->assertSame(432, $game->getId());
        $this->assertSame("Minecraft", $game->getName());
    }

    /**
     * @throws ApiException
     */
    public function testGetGameVersionTypes(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionTypes.json"))]);

        $versionTypes = $client->getGameVersionTypes(432);

        $this->assertGetRequest("/v1/games/432/version-types");
        $this->assertCount(3, $versionTypes);
        $this->assertContainsOnlyInstancesOf(GameVersionType::class, $versionTypes);
        $this->assertInstanceOf(GameVersionTypeModel::class, $versionTypes[0]);
        $this->assertSame("Minecraft 1.1", $versionTypes[0]->getName());
    }

    /**
     * @throws ApiException
     */
    public function testGetGameVersions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionsV2.json"))]);

        $versions = $client->getGameVersions(432);

        $this->assertGetRequest("/v2/games/432/versions");
        $this->assertCount(3, $versions);
        $this->assertContainsOnlyInstancesOf(GameVersionsByTypeV2::class, $versions);
        $this->assertSame(3, $versions[0]->getType());
    }

    /**
     * @throws ApiException
     */
    public function testGetGameVersionsByType(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionsV2.json"))]);

        $versions = $client->getGameVersionsByType(432, 11);

        $this->assertGetRequest("/v2/games/432/versions");
        $this->assertContainsOnlyInstancesOf(GameVersion::class, $versions);
        $this->assertSame(["1.5.3", "1.5.2", "1.5.1"], array_map(fn(GameVersion $version) => $version->getName(), $versions));
    }

    /**
     * @throws ApiException
     */
    public function testGetGameVersionsByUnknownTypeReturnsEmptyArray(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionsV2.json"))]);

        $this->assertSame([], $client->getGameVersionsByType(432, 1));
    }

    /**
     * @throws ApiException
     */
    public function testGetCategories(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getCategories.json"))]);

        $categories = $client->getCategories(432);

        $this->assertGetRequest("/v1/categories", ["gameId" => "432"]);
        $this->assertArrayNotHasKey("classId", $this->getQuery());
        $this->assertArrayNotHasKey("classesOnly", $this->getQuery());
        $this->assertCount(5, $categories);
        $this->assertContainsOnlyInstancesOf(Category::class, $categories);
    }

    /**
     * @throws ApiException
     */
    public function testGetCategoriesWithClassIdAndClassesOnly(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getCategories.json"))]);

        $client->getCategories(432, 6, true);

        $this->assertGetRequest("/v1/categories", ["gameId" => "432", "classId" => "6", "classesOnly" => "true"]);
    }

    /**
     * @throws ApiException
     */
    public function testGetCategory(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getCategories.json"))]);

        $category = $client->getCategory(432, 435);

        $this->assertGetRequest("/v1/categories", ["gameId" => "432"]);
        $this->assertInstanceOf(CategoryModel::class, $category);
        $this->assertSame("Server Utility", $category->getName());
    }

    /**
     * @throws ApiException
     */
    public function testGetUnknownCategoryReturnsNull(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getCategories.json"))]);

        $this->assertNull($client->getCategory(432, 1));
    }

    /**
     * @throws ApiException
     */
    public function testSearchMods(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);

        $mods = $client->searchMods((new ModSearchOptions(432))->setSearchFilter("mclogs")->setPageSize(2));

        $this->assertGetRequest("/v1/mods/search", ["gameId" => "432", "index" => "0", "pageSize" => "2", "searchFilter" => "mclogs"]);
        $this->assertCount(2, $mods);
        $this->assertContainsOnlyInstancesOf(Mod::class, $mods->getResults());
        $this->assertSame(2, $mods->getPagination()->getTotalCount());
        $this->assertSame("mclo-gs", $mods[0]->getSlug());
        $this->assertSame("mclogs", $mods[1]->getSlug());
    }

    /**
     * @throws ApiException
     */
    public function testSearchModsSendsAllOptions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);
        $options = (new ModSearchOptions(432, 10, 20))
            ->setClassId(6)
            ->setCategoryIds([435, 436])
            ->setGameVersions(["1.21.1", "1.20.1"])
            ->setSearchFilter("mclogs")
            ->setSortField(ModSearchSortField::POPULARITY)
            ->setSortOrder(SortOrder::DESCENDING)
            ->setModLoaderTypes([ModLoaderType::FORGE, ModLoaderType::FABRIC])
            ->setGameVersionTypeId(77784)
            ->setAuthorId(100)
            ->setPrimaryAuthorId(101)
            ->setPremiumType(PremiumType::FREE)
            ->setSlug("mclo-gs")
            ->setClientCompatible(true)
            ->setModsSearchEnhancedFeatures(1);

        $client->searchMods($options);

        $this->assertGetRequest("/v1/mods/search", [
            "gameId" => "432",
            "index" => "10",
            "pageSize" => "20",
            "classId" => "6",
            "categoryIds" => "[435,436]",
            "gameVersions" => '["1.21.1","1.20.1"]',
            "searchFilter" => "mclogs",
            "sortField" => "2",
            "sortOrder" => "desc",
            "modLoaderTypes" => "[1,4]",
            "gameVersionTypeId" => "77784",
            "authorId" => "100",
            "primaryAuthorId" => "101",
            "PremiumType" => "2",
            "slug" => "mclo-gs",
            "clientCompatible" => "true",
            "modsSearchEnhancedFeatures" => "1",
        ]);
    }

    /**
     * @throws ApiException
     */
    public function testSearchModsLimitsPageSize(): void
    {
        $client = $this->createClient([
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json")),
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json")),
        ]);

        $client->searchMods(new ModSearchOptions(432, 0, 100));
        $client->searchMods(new ModSearchOptions(432, 9990, 50));

        $this->assertGetRequest("/v1/mods/search", ["index" => "0", "pageSize" => "50"]);
        $this->assertGetRequest("/v1/mods/search", ["index" => "9990", "pageSize" => "10"], 1);
    }

    /**
     * @throws ApiException
     */
    public function testGetMod(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMod.json"))]);

        $mod = $client->getMod(420561);

        $this->assertGetRequest("/v1/mods/420561");
        $this->assertInstanceOf(ModModel::class, $mod);
        $this->assertSame(420561, $mod->getId());
        $this->assertSame("mclo-gs", $mod->getSlug());
        $this->assertSame("Mclogs - mclo.gs", $mod->getName());
        $this->assertSame(6, $mod->getClassId());
        $this->assertSame(435, $mod->getPrimaryCategoryId());
    }

    /**
     * Wrappers are serialized like the generated model, without the client.
     *
     * @throws ApiException
     */
    public function testWrapperIsSerializedLikeModel(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMod.json"))]);

        $mod = $client->getMod(420561);

        $json = json_decode(json_encode($mod), true);
        $this->assertSame(420561, $json["id"]);
        $this->assertSame("mclo-gs", $json["slug"]);
        $this->assertArrayNotHasKey("client", $json);
        $this->assertSame(435, $json["categories"][0]["id"]);
        $this->assertArrayNotHasKey("client", $json["categories"][0]);
        $this->assertSame(3553911, $json["latestFiles"][0]["id"]);
        $this->assertArrayNotHasKey("client", $json["latestFiles"][0]);
    }

    /**
     * @throws ApiException
     */
    public function testGetMods(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMods.json"))]);

        $mods = $client->getMods([420561, 278568, 715033]);

        $this->assertPostRequest("/v1/mods", ["modIds" => [420561, 278568, 715033], "devModIds" => [], "filterPcOnly" => null]);
        $this->assertCount(3, $mods);
        $this->assertContainsOnlyInstancesOf(Mod::class, $mods);
        $this->assertSame(["mclo-gs", "mclogs", "motd-gg"], array_map(fn(Mod $mod) => $mod->getSlug(), $mods));
    }

    /**
     * @throws ApiException
     */
    public function testGetModsWithDevModIdsAndFilterPcOnly(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMods.json"))]);

        $client->getMods([420561], [278568], true);

        $this->assertPostRequest("/v1/mods", ["modIds" => [420561], "devModIds" => [278568], "filterPcOnly" => true]);
    }

    /**
     * @throws ApiException
     */
    public function testGetFeaturedMods(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getFeaturedMods.json"))]);

        $featuredMods = $client->getFeaturedMods(432);

        $this->assertPostRequest("/v1/mods/featured", ["gameId" => 432, "excludedModIds" => [], "gameVersionTypeId" => null]);
        $slugs = fn(array $mods) => array_map(fn(Mod $mod) => $mod->getSlug(), $mods);
        $this->assertSame(["complex-cobblemon", "cobblemon-gg"], $slugs($featuredMods->getFeatured()));
        $this->assertSame(["geckolib", "jei"], $slugs($featuredMods->getPopular()));
        $this->assertSame(["aspects-reclaimed", "pixelcrystaloptimizer"], $slugs($featuredMods->getRecentlyUpdated()));
    }

    /**
     * @throws ApiException
     */
    public function testGetFeaturedModsWithOptions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getFeaturedMods.json"))]);

        $client->getFeaturedMods(432, [420561], 77784, false);

        $this->assertPostRequest("/v1/mods/featured", [
            "gameId" => 432,
            "excludedModIds" => [420561],
            "gameVersionTypeId" => 77784,
            "clientCompatible" => false,
        ]);
    }

    /**
     * @throws ApiException
     */
    public function testGetModDescription(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModDescription.json"))]);

        $description = $client->getModDescription(420561);

        $this->assertGetRequest("/v1/mods/420561/description");
        $this->assertArrayNotHasKey("lang", $this->getQuery());
        $this->assertStringStartsWith('<div style="text-align:center">', $description);
    }

    /**
     * @throws ApiException
     */
    public function testGetModDescriptionWithLanguage(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModDescription.json"))]);

        $client->getModDescription(420561, "de");

        $this->assertGetRequest("/v1/mods/420561/description", ["lang" => "de"]);
    }

    /**
     * @throws ApiException
     */
    public function testGetModFiles(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFiles.json"))]);

        $files = $client->getModFiles(new ModFilesOptions(420561));

        $this->assertGetRequest("/v1/mods/420561/files", ["index" => "0", "pageSize" => "50"]);
        $this->assertSame(["index", "pageSize"], array_keys($this->getQuery()));
        $this->assertCount(2, $files);
        $this->assertContainsOnlyInstancesOf(File::class, $files->getResults());
        $this->assertSame(117, $files->getPagination()->getTotalCount());
        $this->assertSame("mclogs-neoforge-26.1-3.3.4.jar", $files[0]->getFileName());
        $this->assertSame("mclogs-fabric-26.1-3.3.4.jar", $files[1]->getFileName());
    }

    /**
     * @throws ApiException
     */
    public function testGetModFilesSendsAllOptions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFiles.json"))]);
        $options = (new ModFilesOptions(420561, 10, 20))
            ->setGameVersion("1.21.1")
            ->setModLoaderType(ModLoaderType::FABRIC)
            ->setGameVersionTypeId(77784)
            ->setOlderThanProjectFileId(8946029)
            ->setReleaseTypes([FileReleaseType::RELEASE, FileReleaseType::BETA])
            ->setPlatformType(PlatformType::WINDOWS)
            ->setClientCompatible(true);

        $client->getModFiles($options);

        $this->assertGetRequest("/v1/mods/420561/files", [
            "index" => "10",
            "pageSize" => "20",
            "gameVersion" => "1.21.1",
            "modLoaderType" => "4",
            "gameVersionTypeId" => "77784",
            "olderThanProjectFileId" => "8946029",
            "releaseTypes" => ["1", "2"],
            "platformType" => "1",
            "clientCompatible" => "true",
        ]);
    }

    /**
     * @throws ApiException
     */
    public function testGetModFilesNextPageKeepsOptions(): void
    {
        $client = $this->createClient([
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFiles.json")),
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFiles.json")),
        ]);

        $files = $client->getModFiles((new ModFilesOptions(420561, 0, 2))->setGameVersion("1.21.1"));
        $files->getNextPage();

        $this->assertGetRequest("/v1/mods/420561/files", ["index" => "2", "pageSize" => "2", "gameVersion" => "1.21.1"], 1);
    }

    /**
     * @throws ApiException
     */
    public function testGetModFile(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFile.json"))]);

        $file = $client->getModFile(420561, 8946029);

        $this->assertGetRequest("/v1/mods/420561/files/8946029");
        $this->assertInstanceOf(FileModel::class, $file);
        $this->assertSame(8946029, $file->getId());
        $this->assertSame(420561, $file->getModId());
        $this->assertSame("mclogs-integration 3.3.4", $file->getDisplayName());
        $this->assertSame("mclogs-neoforge-26.1-3.3.4.jar", $file->getFileName());
        $this->assertSame(FileReleaseType::RELEASE, $file->getReleaseType());
        $this->assertSame(317339, $file->getFileLength());
    }

    /**
     * @throws ApiException
     */
    public function testGetFiles(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getFiles.json"))]);

        $files = $client->getFiles([8946029, 8946028]);

        $this->assertPostRequest("/v1/mods/files", ["fileIds" => [8946029, 8946028]]);
        $this->assertCount(2, $files);
        $this->assertContainsOnlyInstancesOf(File::class, $files);
        $this->assertSame([8946029, 8946028], array_map(fn(File $file) => $file->getId(), $files));
    }

    /**
     * @throws ApiException
     */
    public function testGetModFileChangelog(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFileChangelog.json"))]);

        $changelog = $client->getModFileChangelog(420561, 8946029);

        $this->assertGetRequest("/v1/mods/420561/files/8946029/changelog");
        $this->assertSame([], $this->getQuery());
        $this->assertSame("<ul>\n<li>List 26.3 support</li>\n</ul>\n", $changelog);
    }

    /**
     * @throws ApiException
     */
    public function testGetModFileChangelogWithOptions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFileChangelog.json"))]);

        $client->getModFileChangelog(420561, 8946029, true, false, true);

        $this->assertGetRequest("/v1/mods/420561/files/8946029/changelog", ["raw" => "true", "stripped" => "false", "markup" => "true"]);
    }

    /**
     * @throws ApiException
     */
    public function testGetModFileDownloadURL(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFileDownloadURL.json"))]);

        $url = $client->getModFileDownloadURL(420561, 8946029);

        $this->assertGetRequest("/v1/mods/420561/files/8946029/download-url");
        $this->assertSame("https://edge.forgecdn.net/files/8946/29/mclogs-neoforge-26.1-3.3.4.jar", $url);
    }

    /**
     * Create an HTTP client that answers with a single game and records all requests in the given history
     *
     * @param array $history
     * @return Client
     */
    protected function createHttpClient(array &$history): Client
    {
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{"data": {"id": 432}}')]));
        $stack->push(Middleware::history($history));
        return new Client(['handler' => $stack]);
    }
}
