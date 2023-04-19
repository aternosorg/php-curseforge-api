# Aternos\CurseForgeApi\FilesApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getFiles()**](FilesApi.md#getFiles) | **POST** /mods/files | Get files |
| [**getModFile()**](FilesApi.md#getModFile) | **GET** /mods/{modId}/files/{fileId} | Get mod file. |
| [**getModFileChangelog()**](FilesApi.md#getModFileChangelog) | **GET** /mods/{modId}/files/{fileId}/changelog | Get mod file changelog |
| [**getModFileDownloadURL()**](FilesApi.md#getModFileDownloadURL) | **GET** /mods/{modId}/files/{fileId}/download-url | Get Mod File Download URL |
| [**getModFiles()**](FilesApi.md#getModFiles) | **GET** /mods/{modId}/files | Get mod files. |


## `getFiles()`

```php
getFiles($get_mod_files_request_body): \Aternos\CurseForgeApi\Model\GetFilesResponse
```

Get files

Get a list of files.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$get_mod_files_request_body = new \Aternos\CurseForgeApi\Model\GetModFilesRequestBody(); // \Aternos\CurseForgeApi\Model\GetModFilesRequestBody

try {
    $result = $apiInstance->getFiles($get_mod_files_request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->getFiles: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_mod_files_request_body** | [**\Aternos\CurseForgeApi\Model\GetModFilesRequestBody**](../Model/GetModFilesRequestBody.md)|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetFilesResponse**](../Model/GetFilesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getModFile()`

```php
getModFile($mod_id, $file_id): \Aternos\CurseForgeApi\Model\GetModFileResponse
```

Get mod file.

Get a single file of the specified mod.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$mod_id = 56; // int | The mod id the file belongs to
$file_id = 56; // int | The file id.

try {
    $result = $apiInstance->getModFile($mod_id, $file_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->getModFile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id the file belongs to | |
| **file_id** | **int**| The file id. | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModFileResponse**](../Model/GetModFileResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getModFileChangelog()`

```php
getModFileChangelog($mod_id, $file_id): \Aternos\CurseForgeApi\Model\GetModFileChangelogResponse
```

Get mod file changelog

Get the changelog of a file in HTML format.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$mod_id = 56; // int | The mod id the file belongs to
$file_id = 56; // int | The file id.

try {
    $result = $apiInstance->getModFileChangelog($mod_id, $file_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->getModFileChangelog: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id the file belongs to | |
| **file_id** | **int**| The file id. | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModFileChangelogResponse**](../Model/GetModFileChangelogResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getModFileDownloadURL()`

```php
getModFileDownloadURL($mod_id, $file_id): \Aternos\CurseForgeApi\Model\GetModFileDownloadURLResponse
```

Get Mod File Download URL

Get a download url for a specific file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$mod_id = 56; // int | The mod id the file belongs to
$file_id = 56; // int | The file id.

try {
    $result = $apiInstance->getModFileDownloadURL($mod_id, $file_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->getModFileDownloadURL: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id the file belongs to | |
| **file_id** | **int**| The file id. | |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModFileDownloadURLResponse**](../Model/GetModFileDownloadURLResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getModFiles()`

```php
getModFiles($mod_id, $game_version, $mod_loader_type, $game_version_type_id, $index, $page_size): \Aternos\CurseForgeApi\Model\GetModFilesResponse
```

Get mod files.

Get all files of the specified mod.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\FilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$mod_id = 56; // int | The mod id the files belong to
$game_version = 'game_version_example'; // string | Filter by game version string
$mod_loader_type = new \Aternos\CurseForgeApi\Model\ModLoaderType(); // ModLoaderType | ModLoaderType enumeration Filter only files associated to a given modloader (Forge, Fabric ...).
$game_version_type_id = 56; // int | Filter only files that are tagged with versions of the given gameVersionTypeId
$index = 56; // int | A zero based index of the first item to include in the response, the limit is: (index + pageSize <= 10,000).
$page_size = 56; // int | The number of items to include in the response, the default/maximum value is 50.

try {
    $result = $apiInstance->getModFiles($mod_id, $game_version, $mod_loader_type, $game_version_type_id, $index, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FilesApi->getModFiles: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_id** | **int**| The mod id the files belong to | |
| **game_version** | **string**| Filter by game version string | [optional] |
| **mod_loader_type** | [**ModLoaderType**](../Model/.md)| ModLoaderType enumeration Filter only files associated to a given modloader (Forge, Fabric ...). | [optional] |
| **game_version_type_id** | **int**| Filter only files that are tagged with versions of the given gameVersionTypeId | [optional] |
| **index** | **int**| A zero based index of the first item to include in the response, the limit is: (index + pageSize &lt;&#x3D; 10,000). | [optional] |
| **page_size** | **int**| The number of items to include in the response, the default/maximum value is 50. | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\GetModFilesResponse**](../Model/GetModFilesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
