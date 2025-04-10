<?php

namespace Aternos\CurseForgeApi\Tests\Integration\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Model\FingerprintMatch;
use Aternos\CurseForgeApi\Model\SortOrder;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    protected ?CurseForgeAPIClient $apiClient = null;

    protected const int MINECRAFT_GAME_ID = 432;

    protected const int MODS_CATEGORY_ID = 6;

    protected const int MCLOGS_MOD_ID = 420561;

    protected const int MCLOGS_PLUGIN_ID = 278568;

    protected const int MOTDGG_PLUGIN_ID = 715033;

    protected const int MCLOGS_PRIMARY_CATEGORY_ID = 435;

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
        $this->apiClient = new CurseForgeAPIClient(getenv("CURSEFORGE_API_KEY"));
        $this->apiClient->setUserAgent("aternos/php-curseforge-api@1.0.0 (contact@aternos.org)");
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test getting games
     * @return void
     * @throws ApiException
     */
    public function testGetGames()
    {
        $games = $this->apiClient->getGames();
        $this->assertNotEmpty($games);

        $games = $this->apiClient->getGames(0, 5);
        $this->assertNotEmpty($games);
        $this->assertCount(5, $games);
        $this->assertFalse($games->hasPreviousPage());
        $this->assertTrue($games->hasNextPage());

        $firstGameOfPage = [];
        while ($games->hasNextPage()) {
            $firstGameOfPage[] = $games->getResults()[0]->getData()->getId();
            $games = $games->getNextPage();
        }
        $this->assertTrue($games->hasPreviousPage());
        $this->assertFalse($games->hasNextPage());

        while ($games->hasPreviousPage()) {
            $games = $games->getPreviousPage();
            $this->assertEquals($firstGameOfPage[array_key_last($firstGameOfPage)], $games->getResults()[0]->getData()->getId());
            array_pop($firstGameOfPage);
        }
        $this->assertFalse($games->hasPreviousPage());
        $this->assertTrue($games->hasNextPage());
    }

    /**
     * Test getting a game
     * @return void
     * @throws ApiException
     */
    public function testGetGame()
    {
        $game = $this->apiClient->getGame(static::MINECRAFT_GAME_ID);
        $this->assertEquals(static::MINECRAFT_GAME_ID, $game->getData()->getId());
        $this->assertEquals("Minecraft", $game->getData()->getName());

        $versions = $game->getVersions();
        $this->assertNotEmpty($versions);

        $categories = $game->getCategories();
        $this->assertNotEmpty($categories);
    }

    /**
     * Test getting game
     * @return void
     * @throws ApiException
     */
    public function testGetGameVersions()
    {
        $versions = $this->apiClient->getGameVersions(static::MINECRAFT_GAME_ID);
        $this->assertNotEmpty($versions);
    }

    /**
     * Test getting version types and their versions for a game
     * @return void
     * @throws ApiException
     */
    public function testGetGameVersionTypes()
    {
        $game = $this->apiClient->getGame(static::MINECRAFT_GAME_ID);
        $this->assertEquals(static::MINECRAFT_GAME_ID, $game->getData()->getId());
        $this->assertEquals("Minecraft", $game->getData()->getName());
        $types = $game->getVersionTypes();
        $this->assertNotEmpty($types);
        foreach ($types as $type) {
            $this->assertEquals($game, $type->getGame());
            $gameVersions = $game->getGameVersionsByType($type->getData()->getId());
            $this->assertEquals($gameVersions, $type->getVersions());
        }
    }

    /**
     * Test getting categories
     * @return void
     * @throws ApiException
     */
    public function testGetCategories()
    {
        $categories = $this->apiClient->getCategories(static::MINECRAFT_GAME_ID);
        $this->assertNotEmpty($categories);

        for ($i = 0; $i < 3; $i++) {
            $category = $categories[$i];
            $this->assertEquals(static::MINECRAFT_GAME_ID, $category->getGame()->getData()->getId());

            $mods = $category->getMods();
            $this->assertNotEmpty($mods);
            foreach ($mods->getResults() as $mod) {
                if ($category->getData()->getIsClass()) {
                    $this->assertEquals($category->getData()->getId(), $mod->getData()->getClassId());
                }
                else {
                    $this->assertContains($category->getData()->getId(),
                        array_map(fn($category) => $category->getId(), $mod->getData()->getCategories()));
                }
            }
        }
    }

    /**
     * Test getting categories
     * @return void
     * @throws ApiException
     */
    public function testGetCategoriesOnlyClasses()
    {
        $categories = $this->apiClient->getCategories(static::MINECRAFT_GAME_ID, null, true);
        $this->assertNotEmpty($categories);
        foreach ($categories as $category) {
            $this->assertTrue($category->getData()->getIsClass());
        }

        for ($i = 0; $i < 3; $i++) {
            $category = $categories[$i];
            $this->assertEquals(static::MINECRAFT_GAME_ID, $category->getGame()->getData()->getId());

            $mods = $category->getMods();
            $this->assertNotEmpty($mods);
            foreach ($mods->getResults() as $mod) {
                if ($category->getData()->getIsClass()) {
                    $this->assertEquals($category->getData()->getId(), $mod->getData()->getClassId());
                }
                else {
                    $this->assertContains($category->getData()->getId(),
                        array_map(fn($category) => $category->getId(), $mod->getData()->getCategories()));
                }
            }
        }
    }

    public function testGetCategory()
    {
        $category = $this->apiClient->getCategory(static::MINECRAFT_GAME_ID, static::MCLOGS_PRIMARY_CATEGORY_ID);
        $this->assertNotNull($category);

        $this->assertEquals(static::MCLOGS_PRIMARY_CATEGORY_ID, $category->getData()->getId());

        $category = $this->apiClient->getCategory(static::MINECRAFT_GAME_ID, -1);
        $this->assertNull($category);
    }

    /**
     * Test getting categories in a category class
     * @return void
     * @throws ApiException
     */
    public function testGetCategoriesInClass()
    {
        $categories = $this->apiClient->getCategories(static::MINECRAFT_GAME_ID, static::MODS_CATEGORY_ID);
        $this->assertNotEmpty($categories);
        foreach ($categories as $category) {
            $this->assertNotTrue($category->getData()->getIsClass());
            $this->assertEquals(static::MODS_CATEGORY_ID, $category->getData()->getClassId());
        }
    }

    /**
     * Test searching mods
     * @return void
     * @throws ApiException
     */
    public function testSearchMods()
    {
        $options = new ModSearchOptions(static::MINECRAFT_GAME_ID);
        $mods = $this->apiClient->searchMods($options);
        $this->assertNotEmpty($mods);
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
        }

        $this->assertNull($mods->getPreviousPage());

        $mods = $mods->getNextPage();
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
        }

        $game = $this->apiClient->getGame(static::MINECRAFT_GAME_ID);
        $mods = $game->searchMods();
        $this->assertNotEmpty($mods);
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
        }
    }

    public function testSearchModsLastPage()
    {
        $options = new ModSearchOptions(static::MINECRAFT_GAME_ID);
        $options->setPageSize(50);
        $options->setOffset(9_960);

        $mods = $this->apiClient->searchMods($options);
        $this->assertNotEmpty($mods);
        $this->assertFalse($mods->hasNextPage());
        $this->assertEquals($mods::LIMIT, $mods->getPagination()->getIndex() + $mods->getPagination()->getPageSize());
    }

    public function testSearchModsLastPageNext()
    {
        $options = new ModSearchOptions(static::MINECRAFT_GAME_ID);
        $options->setPageSize(50);
        $options->setOffset(9_910);

        $mods = $this->apiClient->searchMods($options);
        $this->assertNotEmpty($mods);
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
        }

        $this->assertTrue($mods->hasNextPage());
        $mods = $mods->getNextPage();

        $this->assertNotEmpty($mods);
        $this->assertFalse($mods->hasNextPage());
        $this->assertEquals($mods::LIMIT, $mods->getPagination()->getIndex() + $mods->getPagination()->getPageSize());
    }


    /**
     * Test searching mods in a category class
     * @return void
     * @throws ApiException
     */
    public function testSearchModsInClass()
    {
        $options = new ModSearchOptions(static::MINECRAFT_GAME_ID, classId: static::MODS_CATEGORY_ID);
        $mods = $this->apiClient->searchMods($options);
        $this->assertNotEmpty($mods);
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
            $this->assertEquals(static::MODS_CATEGORY_ID, $mod->getData()->getClassId());
        }
    }

    /**
     * Test fetching a specific mod
     * @return void
     * @throws ApiException
     */
    public function testGetMod()
    {
        $mod = $this->apiClient->getMod(static::MCLOGS_MOD_ID);

        $this->assertEquals(static::MCLOGS_MOD_ID, $mod->getData()->getId());
        $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getGame()->getData()->getId());
        $this->assertEquals(static::MCLOGS_PRIMARY_CATEGORY_ID, $mod->getPrimaryCategory()->getData()->getId());
        $this->assertEquals(static::MODS_CATEGORY_ID, $mod->getCategoryClass()->getData()->getId());
    }

    /**
     * Test fetching multiple mods at once
     * @return void
     * @throws ApiException
     */
    public function testGetMods()
    {
        $ids = [static::MCLOGS_MOD_ID, static::MCLOGS_PLUGIN_ID, static::MOTDGG_PLUGIN_ID];
        $mods = $this->apiClient->getMods($ids);
        $this->assertSameSize($ids, $mods);
        foreach ($ids as $id) {
            $this->assertNotEmpty(array_filter($mods, fn ($mod) => $mod->getData()->getId() === $id));
        }
    }

    /**
     * Test fetching featured mods
     * @return void
     * @throws ApiException
     */
    public function testGetFeaturedMods()
    {
        $game = $this->apiClient->getGame(static::MINECRAFT_GAME_ID);
        $featured = $game->getFeaturedMods();

        $this->assertNotEmpty($featured->getFeatured());
        $this->assertNotEmpty($featured->getRecentlyUpdated());
        $this->assertNotEmpty($featured->getPopular());
    }

    /**
     * Test fetching mod descriptions
     * @return void
     * @throws ApiException
     */
    public function testGetModDescription()
    {
        $mod = $this->apiClient->getMod(static::MCLOGS_MOD_ID);
        $description = $mod->getDescription();
        $this->assertNotNull($description);
        $this->assertNotEmpty($description);
    }

    /**
     * Test fetching a mods main file
     * @return void
     * @throws ApiException
     */
    public function testGetModFile()
    {
        $mod = $this->apiClient->getMod(static::MCLOGS_MOD_ID);

        $file = $mod->getMainFile();


        $this->assertEquals($mod, $file->getMod());

        $this->assertEquals($mod->getData()->getMainFileId(), $file->getData()->getId());
        $this->assertNotNull($file->getChangelog());

        $this->assertTrue($mod->getData()->getAllowModDistribution());
        $this->assertNotEmpty($this->apiClient->getModFileDownloadURL($mod->getData()->getId(), $file->getData()->getId()));

        $this->assertNull($file->getServerPack());
    }

    /**
     * Test fetching files
     * @return void
     * @throws ApiException
     */
    public function testGetModFiles()
    {
        $mod = $this->apiClient->getMod(static::MCLOGS_MOD_ID);

        $fileIds = array_map(fn($file) => $file->getData()->getId(), $mod->getFiles()->getResults());
        $this->assertNotEmpty($fileIds);
        $files = $this->apiClient->getFiles($fileIds);
        $this->assertSameSize($fileIds, $files);
        foreach ($fileIds as $id) {
            $this->assertNotEmpty(array_filter($files, fn($file) => $file->getData()->getId() === $id));
        }
    }

    /**
     * Test searching for files with fingerprints
     * @return void
     * @throws ApiException
     */
    public function testGetFilesByFingerPrintMatches()
    {
        $fingerprints = [1949504940, 1177254054];
        $fileIds = [3602226, 4096696];
        $files = $this->apiClient->getFilesByFingerPrintMatches($fingerprints);

        $this->assertSameSize($fingerprints, $files->getExactFingerprints());
        $this->assertSameSize($fingerprints, $files->getExactMatches());
        foreach ($fileIds as $id) {
            $this->assertNotEmpty(array_filter($files->getExactMatches(),
                fn(FingerprintMatch $file) => $file->getFile()->getId() === $id));
        }
    }

    /**
     * Test searching for files with fingerprints in a specific game
     * @return void
     * @throws ApiException
     */
    public function testGetFilesByFingerPrintMatchesForGame()
    {
        $fingerprints = [1949504940, 1177254054];
        $fileIds = [3602226, 4096696];
        $files = $this->apiClient->getFilesByFingerPrintMatches($fingerprints, static::MINECRAFT_GAME_ID);

        $this->assertSameSize($fingerprints, $files->getExactFingerprints());
        $this->assertSameSize($fingerprints, $files->getExactMatches());
        foreach ($fileIds as $id) {
            $this->assertNotEmpty(array_filter($files->getExactMatches(),
                fn (FingerprintMatch $file) => $file->getFile()->getId() === $id));
        }
    }

    /**
     * Test fetching minecraft versions
     * @return void
     * @throws ApiException
     */
    public function testGetMinecraftVersions()
    {
        $versions = $this->apiClient->getMinecraftVersions(SortOrder::ASCENDING);
        $this->assertNotEmpty($versions);

        $reverseVersions = $this->apiClient->getMinecraftVersions(SortOrder::DESCENDING);
        $this->assertNotEmpty($reverseVersions);

        $this->assertEquals($versions, array_reverse($reverseVersions)); // BROKEN: ticket #160399
    }

    /**
     * Test fetching specific minecraft versions
     * @return void
     * @throws ApiException
     */
    public function testGetMinecraftVersion()
    {
        foreach (["1.19", "1.16.5", "1.12.2"] as $versionString) {
            $version = $this->apiClient->getMinecraftVersion($versionString);
            $this->assertNotNull($version);
            $this->assertEquals($versionString, $version->getVersionString());
        }
    }

    /**
     * Test fetching minecraft mod loaders
     * @return void
     * @throws ApiException
     */
    public function testGetMinecraftModLoaders()
    {
        foreach ([null, "1.16.5", "1.12.2"] as $version) {
            $modLoaders = $this->apiClient->getMinecraftModLoaders($version);
            $this->assertNotEmpty($modLoaders);
        }
    }

    /**
     * Test fetching specific minecraft mod loaders
     * @return void
     * @throws ApiException
     */
    public function testGetMinecraftModLoader()
    {
        foreach (["forge-36.2.9", "forge-40.2.2", "forge-45.0.9", "fabric-0.14.9-1.19.4"] as $name) {
            $modLoader = $this->apiClient->getMinecraftModLoader($name);
            $this->assertNotNull($modLoader);
        }
    }
}
