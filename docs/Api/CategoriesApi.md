# Aternos\CurseForgeApi\CategoriesApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCategories()**](CategoriesApi.md#getCategories) | **GET** /v1/categories | Get categories |


## `getCategories()`

```php
getCategories($game_id, $class_id, $classes_only): \Aternos\CurseForgeApi\Model\GetCategoriesResponse
```

Get categories

Get all available classes and categories of the specified game. Specify a game id for a list of all game categories, or a class id for a list of categories under that class.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\CategoriesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | A game unique id
$class_id = 56; // int | A class unique id
$classes_only = True; // bool | A flag used with gameId to return only classes

try {
    $result = $apiInstance->getCategories($game_id, $class_id, $classes_only);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CategoriesApi->getCategories: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| A game unique id | |
| **class_id** | **int**| A class unique id | [optional] |
| **classes_only** | **bool**| A flag used with gameId to return only classes | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetCategoriesResponse**](../Model/GetCategoriesResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
