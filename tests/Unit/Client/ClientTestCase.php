<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client;

use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * Base class for unit tests that run against a mocked HTTP client.
 *
 * No test in this hierarchy may perform a real request, so every client is built
 * on a Guzzle MockHandler that answers with the given responses in order.
 */
abstract class ClientTestCase extends TestCase
{
    protected const string API_TOKEN = "test-api-token";

    /**
     * Requests recorded by the history middleware of the most recent client
     * @var array<int, array{request: RequestInterface, response: mixed}>
     */
    protected array $requests = [];

    public function setUp(): void
    {
        $this->requests = [];
    }

    /**
     * Create a client that answers every request with one of the given responses, in order,
     * and records all requests in {@see $requests}.
     *
     * @param Response[] $responses
     * @return CurseForgeAPIClient
     */
    protected function createClient(array $responses = []): CurseForgeAPIClient
    {
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->requests));
        return new CurseForgeAPIClient(static::API_TOKEN, null, new Client(['handler' => $stack]));
    }

    /**
     * Get a request recorded by the history middleware
     * @param int $index
     * @return RequestInterface
     */
    protected function getRequest(int $index = 0): RequestInterface
    {
        $this->assertArrayHasKey($index, $this->requests, "Request " . $index . " was not sent");
        return $this->requests[$index]['request'];
    }

    /**
     * Get the query parameters of a recorded request
     * @param int $index
     * @return array<string, string|string[]>
     */
    protected function getQuery(int $index = 0): array
    {
        $query = [];
        foreach (explode("&", $this->getRequest($index)->getUri()->getQuery()) as $pair) {
            if ($pair === "") {
                continue;
            }
            [$key, $value] = array_map("urldecode", explode("=", $pair, 2) + [1 => ""]);
            if (array_key_exists($key, $query)) {
                $query[$key] = [...(array)$query[$key], $value];
            } else {
                $query[$key] = $value;
            }
        }
        return $query;
    }

    /**
     * Assert that a recorded request is a GET request to the given path that contains the given query parameters
     * @param string $path e.g. /v1/games/432
     * @param array<string, string|string[]> $query expected query parameters, other parameters are ignored
     * @param int $index
     * @return void
     */
    protected function assertGetRequest(string $path, array $query = [], int $index = 0): void
    {
        $request = $this->getRequest($index);
        $this->assertSame("GET", $request->getMethod());
        $this->assertSame($path, $request->getUri()->getPath());

        $actualQuery = $this->getQuery($index);
        foreach ($query as $key => $value) {
            $this->assertArrayHasKey($key, $actualQuery, "Query parameter " . $key . " is missing");
            $this->assertSame($value, $actualQuery[$key], "Query parameter " . $key . " has the wrong value");
        }
    }

    /**
     * Assert that a recorded request is a POST request to the given path with the given JSON body
     * @param string $path e.g. /v1/mods
     * @param array $body expected JSON body, decoded as associative array
     * @param int $index
     * @return void
     */
    protected function assertPostRequest(string $path, array $body, int $index = 0): void
    {
        $request = $this->getRequest($index);
        $this->assertSame("POST", $request->getMethod());
        $this->assertSame($path, $request->getUri()->getPath());
        $this->assertSame($body, json_decode((string)$request->getBody(), true));
    }

    /**
     * Assert the number of requests that were sent
     * @param int $count
     * @return void
     */
    protected function assertRequestCount(int $count): void
    {
        $this->assertCount($count, $this->requests);
    }
}
