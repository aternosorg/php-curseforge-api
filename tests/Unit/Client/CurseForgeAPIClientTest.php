<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\Mod;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Configuration;
use Aternos\CurseForgeApi\Model\ModLoaderType;
use Aternos\CurseForgeApi\Model\ModSearchSortField;
use Aternos\CurseForgeApi\Model\PremiumType;
use Aternos\CurseForgeApi\Model\SortOrder;
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
    public function testSearchMods(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/searchMods.json"))]);

        $mods = $client->searchMods((new ModSearchOptions(432))->setSearchFilter("mclogs")->setPageSize(2));

        $this->assertGetRequest("/v1/mods/search", ["gameId" => "432", "index" => "0", "pageSize" => "2", "searchFilter" => "mclogs"]);
        $this->assertCount(2, $mods);
        $this->assertContainsOnlyInstancesOf(Mod::class, $mods->getResults());
        $this->assertSame(2, $mods->getPagination()->getTotalCount());
        $this->assertSame("mclo-gs", $mods[0]->getData()->getSlug());
        $this->assertSame("mclogs", $mods[1]->getData()->getSlug());
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
        $this->assertSame(420561, $mod->getData()->getId());
        $this->assertSame("mclo-gs", $mod->getData()->getSlug());
        $this->assertSame("Mclogs - mclo.gs", $mod->getData()->getName());
        $this->assertSame(6, $mod->getData()->getClassId());
        $this->assertSame(435, $mod->getData()->getPrimaryCategoryId());
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
        $this->assertSame(["mclo-gs", "mclogs", "motd-gg"], array_map(fn(Mod $mod) => $mod->getData()->getSlug(), $mods));
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
        $slugs = fn(array $mods) => array_map(fn(Mod $mod) => $mod->getData()->getSlug(), $mods);
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
}
