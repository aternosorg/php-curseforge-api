# Aternos\CurseForgeApi\FingerprintsApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getFingerprintFuzzyMatches()**](FingerprintsApi.md#getFingerprintFuzzyMatches) | **POST** /v1/fingerprints/fuzzy | Get Fingerprints Fuzzy Matches |
| [**getFingerprintFuzzyMatchesByGame()**](FingerprintsApi.md#getFingerprintFuzzyMatchesByGame) | **POST** /v1/fingerprints/fuzzy/{gameId} | Get Fingerprints Fuzzy Matches |
| [**getFingerprintMatches()**](FingerprintsApi.md#getFingerprintMatches) | **POST** /v1/fingerprints | Get Fingerprints Matches |
| [**getFingerprintMatchesByGame()**](FingerprintsApi.md#getFingerprintMatchesByGame) | **POST** /v1/fingerprints/{gameId} | Get Fingerprints Matches |


## `getFingerprintFuzzyMatches()`

```php
getFingerprintFuzzyMatches($get_fuzzy_matches_request_body): \Aternos\CurseForgeApi\Model\GetFingerprintFuzzyMatchesResponse
```

Get Fingerprints Fuzzy Matches

Get mod files that match a list of fingerprints using fuzzy matching.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\FingerprintsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_fuzzy_matches_request_body = new \Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody(); // \Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody

try {
    $result = $apiInstance->getFingerprintFuzzyMatches($get_fuzzy_matches_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FingerprintsApi->getFingerprintFuzzyMatches: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_fuzzy_matches_request_body** | [**\Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody**](../Model/GetFuzzyMatchesRequestBody.md)|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFingerprintFuzzyMatchesResponse**](../Model/GetFingerprintFuzzyMatchesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFingerprintFuzzyMatchesByGame()`

```php
getFingerprintFuzzyMatchesByGame($game_id, $get_fuzzy_matches_request_body): \Aternos\CurseForgeApi\Model\GetFingerprintFuzzyMatchesResponse
```

Get Fingerprints Fuzzy Matches

Get mod files that match a list of fingerprints using fuzzy matching.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\FingerprintsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | The game id the find matches in
$get_fuzzy_matches_request_body = new \Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody(); // \Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody

try {
    $result = $apiInstance->getFingerprintFuzzyMatchesByGame($game_id, $get_fuzzy_matches_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FingerprintsApi->getFingerprintFuzzyMatchesByGame: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| The game id the find matches in | |
| **get_fuzzy_matches_request_body** | [**\Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody**](../Model/GetFuzzyMatchesRequestBody.md)|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFingerprintFuzzyMatchesResponse**](../Model/GetFingerprintFuzzyMatchesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFingerprintMatches()`

```php
getFingerprintMatches($get_fingerprint_matches_request_body): \Aternos\CurseForgeApi\Model\GetFingerprintMatchesResponse
```

Get Fingerprints Matches

Get mod files that match a list of fingerprints (murmur2 hashes with seed 1).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\FingerprintsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_fingerprint_matches_request_body = new \Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody(); // \Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody | The request body containing an array of fingerprints

try {
    $result = $apiInstance->getFingerprintMatches($get_fingerprint_matches_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FingerprintsApi->getFingerprintMatches: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_fingerprint_matches_request_body** | [**\Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody**](../Model/GetFingerprintMatchesRequestBody.md)| The request body containing an array of fingerprints | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFingerprintMatchesResponse**](../Model/GetFingerprintMatchesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFingerprintMatchesByGame()`

```php
getFingerprintMatchesByGame($game_id, $get_fingerprint_matches_request_body): \Aternos\CurseForgeApi\Model\GetFingerprintMatchesResponse
```

Get Fingerprints Matches

Get mod files that match a list of fingerprints.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\FingerprintsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | The game id the find matches in
$get_fingerprint_matches_request_body = new \Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody(); // \Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody

try {
    $result = $apiInstance->getFingerprintMatchesByGame($game_id, $get_fingerprint_matches_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FingerprintsApi->getFingerprintMatchesByGame: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| The game id the find matches in | |
| **get_fingerprint_matches_request_body** | [**\Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody**](../Model/GetFingerprintMatchesRequestBody.md)|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFingerprintMatchesResponse**](../Model/GetFingerprintMatchesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
