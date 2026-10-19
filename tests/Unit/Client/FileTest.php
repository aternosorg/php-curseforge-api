<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\File;
use Aternos\CurseForgeApi\Client\Mod;
use Aternos\CurseForgeApi\Model\File as FileModel;
use GuzzleHttp\Psr7\Response;

class FileTest extends ClientTestCase
{
    /**
     * @throws ApiException
     */
    public function testFetchServerPack(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFile.json"))]);
        $file = new File($client, new FileModel(["id" => 8946028, "mod_id" => 420561, "server_pack_file_id" => 8946029]));

        $serverPack = $file->fetchServerPack();

        $this->assertGetRequest("/v1/mods/420561/files/8946029");
        $this->assertInstanceOf(File::class, $serverPack);
        $this->assertSame(8946029, $serverPack->getId());
    }

    /**
     * @throws ApiException
     */
    public function testFetchServerPackWithoutServerPackReturnsNull(): void
    {
        $client = $this->createClient();
        $file = new File($client, new FileModel(["id" => 8946029, "mod_id" => 420561]));

        $this->assertNull($file->fetchServerPack());
        $this->assertRequestCount(0);
    }

    /**
     * @throws ApiException
     */
    public function testFetchChangelog(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getModFileChangelog.json"))]);
        $file = new File($client, new FileModel(["id" => 8946029, "mod_id" => 420561]));

        $changelog = $file->fetchChangelog(true, false, true);

        $this->assertGetRequest("/v1/mods/420561/files/8946029/changelog", ["raw" => "true", "stripped" => "false", "markup" => "true"]);
        $this->assertIsString($changelog);
    }

    /**
     * @throws ApiException
     */
    public function testFetchMod(): void
    {
        $client = $this->createClient([new Response(200, [], file_get_contents(__DIR__ . "/Fixtures/getMod.json"))]);
        $file = new File($client, new FileModel(["id" => 8946029, "mod_id" => 420561]));

        $mod = $file->fetchMod();

        $this->assertGetRequest("/v1/mods/420561");
        $this->assertInstanceOf(Mod::class, $mod);
        $this->assertSame(420561, $mod->getId());
    }
}
