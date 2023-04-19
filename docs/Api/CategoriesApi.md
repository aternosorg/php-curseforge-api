# Aternos\CurseForgeApi\CategoriesApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCategories()**](CategoriesApi.md#getCategories) | **GET** /categories | Get categories |


## `getCategories()`

```php
getCategories($game_id, $class_id): \Aternos\CurseForgeApi\Model\GetCategoriesResponse
```

Get categories

Get all available classes and categories of the specified game. Specify a game id for a list of all game categories, or a class id for a list of categories under that class.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\CategoriesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$game_id = 56; // int | A game unique id
$class_id = 56; // int | A class unique id

try {
    $result = $apiInstance->getCategories($game_id, $class_id);
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

### Return type

[**\Aternos\CurseForgeApi\Model\GetCategoriesResponse**](../Model/GetCategoriesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
