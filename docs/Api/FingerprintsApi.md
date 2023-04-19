# Aternos\CurseForgeApi\FingerprintsApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getFingerprintsFuzzyMatches()**](FingerprintsApi.md#getFingerprintsFuzzyMatches) | **POST** /fingerprints/fuzzy | Get Fingerprints Fuzzy Matches |
| [**getFingerprintsMatches()**](FingerprintsApi.md#getFingerprintsMatches) | **POST** /fingerprints | Get Fingerprints Matches |


## `getFingerprintsFuzzyMatches()`

```php
getFingerprintsFuzzyMatches($get_fuzzy_matches_request_body): \Aternos\CurseForgeApi\Model\GetFingerprintsFuzzyMatchesResponse
```

Get Fingerprints Fuzzy Matches

Get mod files that match a list of fingerprints using fuzzy matching.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FingerprintsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$get_fuzzy_matches_request_body = new \Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody(); // \Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody

try {
    $result = $apiInstance->getFingerprintsFuzzyMatches($get_fuzzy_matches_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FingerprintsApi->getFingerprintsFuzzyMatches: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_fuzzy_matches_request_body** | [**\Aternos\CurseForgeApi\Model\GetFuzzyMatchesRequestBody**](../Model/GetFuzzyMatchesRequestBody.md)|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFingerprintsFuzzyMatchesResponse**](../Model/GetFingerprintsFuzzyMatchesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFingerprintsMatches()`

```php
getFingerprintsMatches($get_fingerprint_matches_request_body): \Aternos\CurseForgeApi\Model\GetFingerprintMatchesResponse
```

Get Fingerprints Matches

Get mod files that match a list of fingerprints.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FingerprintsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$get_fingerprint_matches_request_body = new \Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody(); // \Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody

try {
    $result = $apiInstance->getFingerprintsMatches($get_fingerprint_matches_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FingerprintsApi->getFingerprintsMatches: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_fingerprint_matches_request_body** | [**\Aternos\CurseForgeApi\Model\GetFingerprintMatchesRequestBody**](../Model/GetFingerprintMatchesRequestBody.md)|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFingerprintMatchesResponse**](../Model/GetFingerprintMatchesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
