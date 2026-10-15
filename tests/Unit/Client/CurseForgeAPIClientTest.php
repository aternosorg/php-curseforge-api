<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\ApiException;
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
}
