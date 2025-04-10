# Aternos\CurseForgeApi\GamesApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getGame()**](GamesApi.md#getGame) | **GET** /v1/games/{gameId} | Get game |
| [**getGames()**](GamesApi.md#getGames) | **GET** /v1/games | Get games |
| [**getVersionTypes()**](GamesApi.md#getVersionTypes) | **GET** /v1/games/{gameId}/version-types | Get version types |
| [**getVersions()**](GamesApi.md#getVersions) | **GET** /v1/games/{gameId}/versions | Get versions |
| [**getVersionsV2()**](GamesApi.md#getVersionsV2) | **GET** /v2/games/{gameId}/versions | Get versions |


## `getGame()`

```php
getGame($game_id): \Aternos\CurseForgeApi\Model\GetGameResponse
```

Get game

Get a single game. A private game is only accessible by its respective API key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | A game unique id

try {
    $result = $apiInstance->getGame($game_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GamesApi->getGame: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| A game unique id | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetGameResponse**](../Model/GetGameResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getGames()`

```php
getGames($index, $page_size): \Aternos\CurseForgeApi\Model\GetGamesResponse
```

Get games

Get all games that are available to the provided API key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$index = 56; // int | A zero based index of the first item to include in the response, the limit is: (index + pageSize <= 10,000).
$page_size = 56; // int | The number of items to include in the response, the default/maximum value is 50.

try {
    $result = $apiInstance->getGames($index, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GamesApi->getGames: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **index** | **int**| A zero based index of the first item to include in the response, the limit is: (index + pageSize &lt;&#x3D; 10,000). | [optional] |
| **page_size** | **int**| The number of items to include in the response, the default/maximum value is 50. | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetGamesResponse**](../Model/GetGamesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVersionTypes()`

```php
getVersionTypes($game_id): \Aternos\CurseForgeApi\Model\GetVersionTypesResponse
```

Get version types

Get all available version types of the specified game. A private game is only accessible to its respective API key. Currently, when creating games via the CurseForge Core Console, you are limited to a single game version type. This means that this endpoint is probably not useful in most cases and is relevant mostly when handling existing games that have multiple game versions such as World of Warcraft and Minecraft (e.g. 517 for wow_retail).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | A game unique id

try {
    $result = $apiInstance->getVersionTypes($game_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GamesApi->getVersionTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| A game unique id | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetVersionTypesResponse**](../Model/GetVersionTypesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVersions()`

```php
getVersions($game_id): \Aternos\CurseForgeApi\Model\GetVersionsResponse
```

Get versions

Get all available versions for each known version type of the specified game. A private game is only accessible to its respective API key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | A game unique id

try {
    $result = $apiInstance->getVersions($game_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GamesApi->getVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| A game unique id | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetVersionsResponse**](../Model/GetVersionsResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVersionsV2()`

```php
getVersionsV2($game_id): \Aternos\CurseForgeApi\Model\GetVersionsV2Response
```

Get versions

Get all available versions for each known version type of the specified game. A private game is only accessible to its respective API key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | A game unique id

try {
    $result = $apiInstance->getVersionsV2($game_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling GamesApi->getVersionsV2: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| A game unique id | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetVersionsV2Response**](../Model/GetVersionsV2Response.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
