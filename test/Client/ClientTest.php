<?php

namespace Aternos\CurseForgeApi\Test\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use Aternos\CurseForgeApi\Client\Options\ModSearch\ModSearchOptions;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    protected ?CurseForgeAPIClient $apiClient = null;

    protected const MINECRAFT_GAME_ID = 432;

    protected const MODS_CATEGORY_ID = 6;

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
        $this->apiClient = new CurseForgeAPIClient(getenv("CURSEFORGE_API_TOKEN"));
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

        $game = $this->apiClient->getGame(static::MINECRAFT_GAME_ID);
        $mods = $game->searchMods();
        $this->assertNotEmpty($mods);
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
        }
    }

    /**
     * Test searching mods in a category class
     * @return void
     * @throws ApiException
     */
    public function testSearchModsInClass()
    {
        $options = new ModSearchOptions(static::MINECRAFT_GAME_ID, static::MODS_CATEGORY_ID);
        $mods = $this->apiClient->searchMods($options);
        $this->assertNotEmpty($mods);
        foreach ($mods as $mod) {
            $this->assertEquals(static::MINECRAFT_GAME_ID, $mod->getData()->getGameId());
            $this->assertEquals(static::MODS_CATEGORY_ID, $mod->getData()->getClassId());
        }
    }
}