<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Category;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Client\GameVersionType;
use Aternos\CurseForgeApi\Model\Game as GameModel;
use Aternos\CurseForgeApi\Model\GameVersion;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;
use GuzzleHttp\Psr7\Response;

class GameTest extends ClientTestCase
{
    /**
     * @throws ApiException
     */
    public function testFetchVersionTypes(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionTypes.json"))]);
        $game = new Game($client, new GameModel(["id" => 432]));

        $versionTypes = $game->fetchVersionTypes();

        $this->assertGetRequest("/v1/games/432/version-types");
        $this->assertCount(3, $versionTypes);
        $this->assertContainsOnlyInstancesOf(GameVersionType::class, $versionTypes);
    }

    /**
     * @throws ApiException
     */
    public function testFetchVersions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionsV2.json"))]);
        $game = new Game($client, new GameModel(["id" => 432]));

        $versions = $game->fetchVersions();

        $this->assertGetRequest("/v2/games/432/versions");
        $this->assertContainsOnlyInstancesOf(GameVersionsByTypeV2::class, $versions);
    }

    /**
     * @throws ApiException
     */
    public function testFetchGameVersionsByType(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionsV2.json"))]);
        $game = new Game($client, new GameModel(["id" => 432]));

        $versions = $game->fetchGameVersionsByType(11);

        $this->assertGetRequest("/v2/games/432/versions");
        $this->assertSame(["1.5.3", "1.5.2", "1.5.1"], array_map(fn(GameVersion $version) => $version->getName(), $versions));
    }

    /**
     * @throws ApiException
     */
    public function testFetchCategories(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getCategories.json"))]);
        $game = new Game($client, new GameModel(["id" => 432]));

        $categories = $game->fetchCategories(6, true);

        $this->assertGetRequest("/v1/categories", ["gameId" => "432", "classId" => "6", "classesOnly" => "true"]);
        $this->assertContainsOnlyInstancesOf(Category::class, $categories);
    }

    /**
     * @throws ApiException
     */
    public function testSearchMods(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);
        $game = new Game($client, new GameModel(["id" => 432]));

        $mods = $game->searchMods();

        $this->assertGetRequest("/v1/mods/search", ["gameId" => "432", "index" => "0", "pageSize" => "50"]);
        $this->assertCount(2, $mods);
    }

    /**
     * @throws ApiException
     */
    public function testFetchFeaturedMods(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getFeaturedMods.json"))]);
        $game = new Game($client, new GameModel(["id" => 432]));

        $featuredMods = $game->fetchFeaturedMods([420561], 68441, true);

        $this->assertPostRequest("/v1/mods/featured", [
            "gameId" => 432,
            "excludedModIds" => [420561],
            "gameVersionTypeId" => 68441,
            "clientCompatible" => true,
        ]);
        $this->assertCount(2, $featuredMods->getFeatured());
    }
}
