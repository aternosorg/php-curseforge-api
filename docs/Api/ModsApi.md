# Aternos\CurseForgeApi\ModsApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getFeaturedMods()**](ModsApi.md#getFeaturedMods) | **POST** /mods/featured | Get featured mods. |
| [**getMod()**](ModsApi.md#getMod) | **GET** /mods/{modId} | Get a single mod. |
| [**getModDescription()**](ModsApi.md#getModDescription) | **GET** /mods/{modId}/description | Get mod description. |
| [**getMods()**](ModsApi.md#getMods) | **POST** /mods | Get a list of mods. |
| [**searchMods()**](ModsApi.md#searchMods) | **GET** /mods/search | Get all mods that match the search criteria. |


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



$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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
| **get_featured_mods_request_body** | [**\Aternos\CurseForgeApi\Model\GetFeaturedModsRequestBody**](../Model/GetFeaturedModsRequestBody.md)|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFeaturedModsResponse**](../Model/GetFeaturedModsResponse.md)

### Authorization

No authorization required

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



$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getModDescription()`

```php
getModDescription($mod_id): \Aternos\CurseForgeApi\Model\ModDescriptionResponse
```

Get mod description.

Get the full description of a mod in HTML format.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$mod_id = 56; // int | The mod id.

try {
    $result = $apiInstance->getModDescription($mod_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->getModDescription: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id. | |

### Return type

[**\Aternos\CurseForgeApi\Model\ModDescriptionResponse**](../Model/ModDescriptionResponse.md)

### Authorization

No authorization required

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



$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
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
| **get_mods_by_ids_list_request_body** | [**\Aternos\CurseForgeApi\Model\GetModsByIdsListRequestBody**](../Model/GetModsByIdsListRequestBody.md)|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModsResponse**](../Model/GetModsResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchMods()`

```php
searchMods($game_id, $class_id, $category_id, $game_version, $search_filter, $sort_field, $sort_order, $mod_loader_type, $game_version_type_id, $slug, $index, $page_size): \Aternos\CurseForgeApi\Model\SearchModsResponse
```

Get all mods that match the search criteria.

Get all mods that match the search criteria.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\ModsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$game_id = 56; // int | Filter by game id.
$class_id = 56; // int | Filter by section id (discoverable via Categories)
$category_id = 56; // int | Filter by category id
$game_version = 'game_version_example'; // string | Filter by game version string
$search_filter = 'search_filter_example'; // string | Filter by free text search in the mod name and author
$sort_field = new \Aternos\CurseForgeApi\Model\ModsSearchSortField(); // ModsSearchSortField | Filter by ModsSearchSortField enumeration
$sort_order = new \Aternos\CurseForgeApi\Model\SortOrder(); // SortOrder | 'asc' if sort is in ascending order, 'desc' if sort is in descending order
$mod_loader_type = new \Aternos\CurseForgeApi\Model\ModLoaderType(); // ModLoaderType | Filter only mods associated to a given modloader (Forge, Fabric ...). Must be coupled with gameVersion.
$game_version_type_id = 56; // int | Filter only mods that contain files tagged with versions of the given gameVersionTypeId
$slug = 'slug_example'; // string | Filter by slug (coupled with classId will result in a unique result).
$index = 56; // int | A zero based index of the first item to include in the response, the limit is: (index + pageSize <= 10,000).
$page_size = 56; // int | The number of items to include in the response, the default/maximum value is 50.

try {
    $result = $apiInstance->searchMods($game_id, $class_id, $category_id, $game_version, $search_filter, $sort_field, $sort_order, $mod_loader_type, $game_version_type_id, $slug, $index, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ModsApi->searchMods: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_id** | **int**| Filter by game id. | |
| **class_id** | **int**| Filter by section id (discoverable via Categories) | [optional] |
| **category_id** | **int**| Filter by category id | [optional] |
| **game_version** | **string**| Filter by game version string | [optional] |
| **search_filter** | **string**| Filter by free text search in the mod name and author | [optional] |
| **sort_field** | [**ModsSearchSortField**](../Model/.md)| Filter by ModsSearchSortField enumeration | [optional] |
| **sort_order** | [**SortOrder**](../Model/.md)| &#39;asc&#39; if sort is in ascending order, &#39;desc&#39; if sort is in descending order | [optional] |
| **mod_loader_type** | [**ModLoaderType**](../Model/.md)| Filter only mods associated to a given modloader (Forge, Fabric ...). Must be coupled with gameVersion. | [optional] |
| **game_version_type_id** | **int**| Filter only mods that contain files tagged with versions of the given gameVersionTypeId | [optional] |
| **slug** | **string**| Filter by slug (coupled with classId will result in a unique result). | [optional] |
| **index** | **int**| A zero based index of the first item to include in the response, the limit is: (index + pageSize &lt;&#x3D; 10,000). | [optional] |
| **page_size** | **int**| The number of items to include in the response, the default/maximum value is 50. | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\SearchModsResponse**](../Model/SearchModsResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
