# Aternos\CurseForgeApi\ModsApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getFeaturedMods()**](ModsApi.md#getFeaturedMods) | **POST** /v1/mods/featured | Get featured mods. |
| [**getMod()**](ModsApi.md#getMod) | **GET** /v1/mods/{modId} | Get a single mod. |
| [**getModDescription()**](ModsApi.md#getModDescription) | **GET** /v1/mods/{modId}/description | Get mod description. |
| [**getMods()**](ModsApi.md#getMods) | **POST** /v1/mods | Get a list of mods. |
| [**searchMods()**](ModsApi.md#searchMods) | **GET** /v1/mods/search | Get all mods that match the search criteria. |


## `getFeaturedMods()`

```php
getFeaturedMods($get_featured_mods_request_body): \Aternos\CurseForgeApi\Model\GetFeaturedModsResponse
```

Get featured mods.

Get a list of featured, popular and recently updated mods.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_featured_mods_request_body = new \Aternos\CurseForgeApi\Model\GetFeaturedModsRequestBody(); // \Aternos\CurseForgeApi\Model\GetFeaturedModsRequestBody

try {
    $result = $apiInstance->getFeaturedMods($get_featured_mods_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->getFeaturedMods: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_featured_mods_request_body** | [**\Aternos\CurseForgeApi\Model\GetFeaturedModsRequestBody**](../Model/GetFeaturedModsRequestBody.md)|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFeaturedModsResponse**](../Model/GetFeaturedModsResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getMod()`

```php
getMod($mod_id): \Aternos\CurseForgeApi\Model\GetModResponse
```

Get a single mod.

Get a single mod.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mod_id = 56; // int | The mod id.

try {
    $result = $apiInstance->getMod($mod_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->getMod: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id. | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModResponse**](../Model/GetModResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getModDescription()`

```php
getModDescription($mod_id, $raw, $stripped, $markup): \Aternos\CurseForgeApi\Model\ModDescriptionResponse
```

Get mod description.

Get the full description of a mod in HTML format.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mod_id = 56; // int | The mod id.
$raw = True; // bool | Get raw description without things like external link redirects
$stripped = True; // bool | Get the description with all HTML tags removed
$markup = True; // bool

try {
    $result = $apiInstance->getModDescription($mod_id, $raw, $stripped, $markup);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->getModDescription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id. | |
| **raw** | **bool**| Get raw description without things like external link redirects | [optional] |
| **stripped** | **bool**| Get the description with all HTML tags removed | [optional] |
| **markup** | **bool**|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\ModDescriptionResponse**](../Model/ModDescriptionResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getMods()`

```php
getMods($get_mods_by_ids_list_request_body): \Aternos\CurseForgeApi\Model\GetModsResponse
```

Get a list of mods.

Get a list of mods.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_mods_by_ids_list_request_body = new \Aternos\CurseForgeApi\Model\GetModsByIdsListRequestBody(); // \Aternos\CurseForgeApi\Model\GetModsByIdsListRequestBody

try {
    $result = $apiInstance->getMods($get_mods_by_ids_list_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->getMods: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_mods_by_ids_list_request_body** | [**\Aternos\CurseForgeApi\Model\GetModsByIdsListRequestBody**](../Model/GetModsByIdsListRequestBody.md)|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModsResponse**](../Model/GetModsResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchMods()`

```php
searchMods($game_id, $index, $page_size, $class_id, $category_id, $game_version, $search_filter, $sort_field, $sort_order, $mod_loader_type, $game_version_type_id, $author_id, $slug, $category_ids, $game_versions, $mod_loader_types, $primary_author_id, $premium_type): \Aternos\CurseForgeApi\Model\SearchModsResponse
```

Get all mods that match the search criteria.

Get all mods that match the search criteria.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\CurseForgeApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('x-api-key', 'Bearer');


$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$game_id = 56; // int | Filter by game id.
$index = 56; // int | A zero based index of the first item to include in the response, the limit is: (index + pageSize <= 10,000).
$page_size = 56; // int | The number of items to include in the response, the default/maximum value is 50.
$class_id = 56; // int | Filter by section id (discoverable via Categories)
$category_id = 56; // int | Filter by category id
$game_version = 'game_version_example'; // string | Filter by game version string
$search_filter = 'search_filter_example'; // string | Filter by free text search in the mod name and author
$sort_field = new \Aternos\CurseForgeApi\Model\\Aternos\CurseForgeApi\Model\ModsSearchSortField(); // \Aternos\CurseForgeApi\Model\ModsSearchSortField | Filter by ModsSearchSortField enumeration
$sort_order = new \Aternos\CurseForgeApi\Model\\Aternos\CurseForgeApi\Model\SortOrder(); // \Aternos\CurseForgeApi\Model\SortOrder | 'asc' if sort is in ascending order, 'desc' if sort is in descending order
$mod_loader_type = new \Aternos\CurseForgeApi\Model\\Aternos\CurseForgeApi\Model\ModLoaderType(); // \Aternos\CurseForgeApi\Model\ModLoaderType | Filter only mods associated to a given modloader (Forge, Fabric ...). Must be coupled with gameVersion.
$game_version_type_id = 56; // int | Filter only mods that contain files tagged with versions of the given gameVersionTypeId
$author_id = 56; // int | Filter only mods that the given authorId is a member of.
$slug = 'slug_example'; // string | Filter by slug (coupled with classId will result in a unique result).
$category_ids = 'category_ids_example'; // string | Filter by a list of category ids. this will override categoryId. Limited to 10 items.
$game_versions = 'game_versions_example'; // string | Filter by a list of game version strings. This will override gameVersion. Limited to 4 items.
$mod_loader_types = 'mod_loader_types_example'; // string | Filter by a list of modloader types. This will override modLoaderType. Limited to 5 items.
$primary_author_id = 56; // int | Filter only mods that the given primaryAuthorId is the owner of.
$premium_type = new \Aternos\CurseForgeApi\Model\\Aternos\CurseForgeApi\Model\PremiumType(); // \Aternos\CurseForgeApi\Model\PremiumType | Filter only mods that are Premium or not.

try {
    $result = $apiInstance->searchMods($game_id, $index, $page_size, $class_id, $category_id, $game_version, $search_filter, $sort_field, $sort_order, $mod_loader_type, $game_version_type_id, $author_id, $slug, $category_ids, $game_versions, $mod_loader_types, $primary_author_id, $premium_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->searchMods: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| Filter by game id. | |
| **index** | **int**| A zero based index of the first item to include in the response, the limit is: (index + pageSize &lt;&#x3D; 10,000). | [optional] |
| **page_size** | **int**| The number of items to include in the response, the default/maximum value is 50. | [optional] |
| **class_id** | **int**| Filter by section id (discoverable via Categories) | [optional] |
| **category_id** | **int**| Filter by category id | [optional] |
| **game_version** | **string**| Filter by game version string | [optional] |
| **search_filter** | **string**| Filter by free text search in the mod name and author | [optional] |
| **sort_field** | [**\Aternos\CurseForgeApi\Model\ModsSearchSortField**](../Model/.md)| Filter by ModsSearchSortField enumeration | [optional] |
| **sort_order** | [**\Aternos\CurseForgeApi\Model\SortOrder**](../Model/.md)| &#39;asc&#39; if sort is in ascending order, &#39;desc&#39; if sort is in descending order | [optional] |
| **mod_loader_type** | [**\Aternos\CurseForgeApi\Model\ModLoaderType**](../Model/.md)| Filter only mods associated to a given modloader (Forge, Fabric ...). Must be coupled with gameVersion. | [optional] |
| **game_version_type_id** | **int**| Filter only mods that contain files tagged with versions of the given gameVersionTypeId | [optional] |
| **author_id** | **int**| Filter only mods that the given authorId is a member of. | [optional] |
| **slug** | **string**| Filter by slug (coupled with classId will result in a unique result). | [optional] |
| **category_ids** | **string**| Filter by a list of category ids. this will override categoryId. Limited to 10 items. | [optional] |
| **game_versions** | **string**| Filter by a list of game version strings. This will override gameVersion. Limited to 4 items. | [optional] |
| **mod_loader_types** | **string**| Filter by a list of modloader types. This will override modLoaderType. Limited to 5 items. | [optional] |
| **primary_author_id** | **int**| Filter only mods that the given primaryAuthorId is the owner of. | [optional] |
| **premium_type** | [**\Aternos\CurseForgeApi\Model\PremiumType**](../Model/.md)| Filter only mods that are Premium or not. | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\SearchModsResponse**](../Model/SearchModsResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
