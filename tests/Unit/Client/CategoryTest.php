<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Category;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Model\Category as CategoryModel;
use GuzzleHttp\Psr7\Response;

class CategoryTest extends ClientTestCase
{
    /**
     * @throws ApiException
     */
    public function testFetchModsOfCategory(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);
        $category = new Category($client, new CategoryModel(["id" => 435, "game_id" => 432, "class_id" => 6]));

        $mods = $category->fetchMods();

        $this->assertGetRequest("/v1/mods/search", ["gameId" => "432", "categoryIds" => "[435]", "index" => "0", "pageSize" => "50"]);
        $this->assertCount(2, $mods);
    }

    /**
     * @throws ApiException
     */
    public function testFetchModsOfCategoryClass(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);
        $category = new Category($client, new CategoryModel(["id" => 6, "game_id" => 432, "is_class" => true]));

        $category->fetchMods();

        $this->assertGetRequest("/v1/mods/search", ["gameId" => "432", "classId" => "6", "index" => "0", "pageSize" => "50"]);
    }

    /**
     * @throws ApiException
     */
    public function testFetchModsWithOptions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);
        $category = new Category($client, new CategoryModel(["id" => 435, "game_id" => 432, "class_id" => 6]));

        $category->fetchMods((new ModSearchOptions(432))->setSearchFilter("mclogs"));

        $this->assertGetRequest("/v1/mods/search", ["gameId" => "432", "categoryIds" => "[435]", "searchFilter" => "mclogs", "index" => "0", "pageSize" => "50"]);
    }

    /**
     * @throws ApiException
     */
    public function testFetchGame(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGame.json"))]);
        $category = new Category($client, new CategoryModel(["id" => 435, "game_id" => 432, "class_id" => 6]));

        $game = $category->fetchGame();

        $this->assertGetRequest("/v1/games/432");
        $this->assertInstanceOf(Game::class, $game);
        $this->assertSame(432, $game->getId());
    }
}
