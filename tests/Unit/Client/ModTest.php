<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Category;
use Aternos\CurseForgeApi\Client\File;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Client\Mod;
use Aternos\CurseForgeApi\Client\Options\ModFilesOptions;
use Aternos\CurseForgeApi\Model\Category as CategoryModel;
use Aternos\CurseForgeApi\Model\Mod as ModModel;
use GuzzleHttp\Psr7\Response;

class ModTest extends ClientTestCase
{
    /**
     * Create a mod whose client answers with the given responses
     * @param Response[] $responses
     * @return Mod
     */
    protected function createMod(array $responses = []): Mod
    {
        return new Mod($this->createClient($responses), new ModModel([
            "id" => 420561,
            "game_id" => 432,
            "class_id" => 6,
            "main_file_id" => 8946029,
        ]));
    }

    /**
     * @throws ApiException
     */
    public function testFetchDescription(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModDescription.json"))]);

        $description = $mod->fetchDescription("de");

        $this->assertGetRequest("/v1/mods/420561/description", ["lang" => "de"]);
        $this->assertStringContainsString("mclo.gs", $description);
    }

    /**
     * @throws ApiException
     */
    public function testFetchFiles(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFiles.json"))]);

        $files = $mod->fetchFiles();

        $this->assertGetRequest("/v1/mods/420561/files", ["index" => "0", "pageSize" => "50"]);
        $this->assertContainsOnlyInstancesOf(File::class, $files->getResults());
    }

    /**
     * @throws ApiException
     */
    public function testFetchFilesWithOptions(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFiles.json"))]);

        $mod->fetchFiles((new ModFilesOptions(420561))->setGameVersion("1.21.1"));

        $this->assertGetRequest("/v1/mods/420561/files", ["gameVersion" => "1.21.1", "index" => "0", "pageSize" => "50"]);
    }

    /**
     * @throws ApiException
     */
    public function testFetchGame(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGame.json"))]);

        $game = $mod->fetchGame();

        $this->assertGetRequest("/v1/games/432");
        $this->assertInstanceOf(Game::class, $game);
    }

    /**
     * @throws ApiException
     */
    public function testFetchCategoryClass(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getCategories.json"))]);

        $categoryClass = $mod->fetchCategoryClass();

        $this->assertGetRequest("/v1/categories", ["gameId" => "432"]);
        $this->assertInstanceOf(Category::class, $categoryClass);
        $this->assertSame(6, $categoryClass->getId());
    }

    /**
     * @throws ApiException
     */
    public function testFetchMainFile(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFile.json"))]);

        $file = $mod->fetchMainFile();

        $this->assertGetRequest("/v1/mods/420561/files/8946029");
        $this->assertInstanceOf(File::class, $file);
        $this->assertSame(8946029, $file->getId());
    }

    /**
     * @throws ApiException
     */
    public function testFetchFile(): void
    {
        $mod = $this->createMod([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFile.json"))]);

        $file = $mod->fetchFile(8946029);

        $this->assertGetRequest("/v1/mods/420561/files/8946029");
        $this->assertSame(420561, $file->getModId());
    }

    public function testGetPrimaryCategoryDoesNotSendRequest(): void
    {
        $client = $this->createClient();
        $mod = new Mod($client, new ModModel([
            "id" => 420561,
            "primary_category_id" => 435,
            "categories" => [
                new CategoryModel(["id" => 434]),
                new CategoryModel(["id" => 435]),
            ],
        ]));

        $category = $mod->getPrimaryCategory();

        $this->assertInstanceOf(Category::class, $category);
        $this->assertSame(435, $category->getId());
        $this->assertRequestCount(0);
    }

    /**
     * @throws ApiException
     */
    public function testGetCategoriesReturnsWrappers(): void
    {
        $client = $this->createClient([
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMod.json")),
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGame.json")),
        ]);
        $mod = $client->getMod(420561);

        $categories = $mod->getCategories();

        $this->assertCount(1, $categories);
        $this->assertContainsOnlyInstancesOf(Category::class, $categories);
        $this->assertSame(435, $categories[0]->getId());
        $this->assertRequestCount(1);

        $categories[0]->fetchGame();
        $this->assertGetRequest("/v1/games/432", [], 1);
    }

    public function testGetCategoriesWithoutCategoriesReturnsNull(): void
    {
        $mod = new Mod($this->createClient(), new ModModel(["id" => 420561]));

        $this->assertNull($mod->getCategories());
        $this->assertNull($mod->getPrimaryCategory());
    }

    /**
     * @throws ApiException
     */
    public function testGetLatestFilesReturnsWrappers(): void
    {
        $client = $this->createClient([
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMod.json")),
            new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMod.json")),
        ]);
        $mod = $client->getMod(420561);

        $files = $mod->getLatestFiles();

        $this->assertCount(2, $files);
        $this->assertContainsOnlyInstancesOf(File::class, $files);
        $this->assertSame([3553911, 6235017], array_map(fn(File $file) => $file->getId(), $files));
        $this->assertRequestCount(1);

        $files[0]->fetchMod();
        $this->assertGetRequest("/v1/mods/420561", [], 1);
    }

    public function testGetLatestFilesWithoutFilesReturnsNull(): void
    {
        $mod = new Mod($this->createClient(), new ModModel(["id" => 420561]));

        $this->assertNull($mod->getLatestFiles());
    }
}
