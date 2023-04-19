# Aternos\CurseForgeApi\GamesApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getGame()**](GamesApi.md#getGame) | **GET** /games/{gameId} | Get game |
| [**getGames()**](GamesApi.md#getGames) | **GET** /games | Get games |
| [**getVersionTypes()**](GamesApi.md#getVersionTypes) | **GET** /games/{gameId}/version-types | Get version types |
| [**getVersions()**](GamesApi.md#getVersions) | **GET** /games/{gameId}/versions | Get versions |


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



$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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

No authorization required

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



$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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

No authorization required

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



$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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

No authorization required

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



$apiInstance = new Aternos\CurseForgeApi\Api\GamesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
