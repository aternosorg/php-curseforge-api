<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Game;
use Aternos\CurseForgeApi\Client\GameVersionType;
use Aternos\CurseForgeApi\Configuration;
use Aternos\CurseForgeApi\Model\GameVersion;
use Aternos\CurseForgeApi\Model\GameVersionsByTypeV2;
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
        $this->assertSame("final-fantasy-v", $games[0]->getData()->getSlug());
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
        $this->assertSame(432, $game->getData()->getId());
        $this->assertSame("Minecraft", $game->getData()->getName());
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
        $this->assertSame("Minecraft 1.1", $versionTypes[0]->getData()->getName());
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
}
