<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Client\GameVersionType;
use Aternos\CurseForgeApi\Model\GameVersion;
use Aternos\CurseForgeApi\Model\GameVersionType as GameVersionTypeModel;
use GuzzleHttp\Psr7\Response;

class GameVersionTypeTest extends ClientTestCase
{
    /**
     * @throws ApiException
     */
    public function testFetchVersions(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getVersionsV2.json"))]);
        $versionType = new GameVersionType($client, new GameVersionTypeModel(["id" => 11, "game_id" => 432]));

        $versions = $versionType->fetchVersions();

        $this->assertGetRequest("/v2/games/432/versions");
        $this->assertSame(["1.5.3", "1.5.2", "1.5.1"], array_map(fn(GameVersion $version) => $version->getName(), $versions));
    }

    /**
     * @throws ApiException
     */
    public function testFetchGame(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getGame.json"))]);
        $versionType = new GameVersionType($client, new GameVersionTypeModel(["id" => 11, "game_id" => 432]));

        $game = $versionType->fetchGame();

        $this->assertGetRequest("/v1/games/432");
        $this->assertInstanceOf(Game::class, $game);
        $this->assertSame(432, $game->getId());
    }
}
