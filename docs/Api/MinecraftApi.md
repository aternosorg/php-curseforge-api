# Aternos\CurseForgeApi\MinecraftApi

All URIs are relative to https://api.curseforge.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getMinecraftModLoaders()**](MinecraftApi.md#getMinecraftModLoaders) | **GET** /minecraft/modloader | Get Minecraft ModLoaders |
| [**getMinecraftVersions()**](MinecraftApi.md#getMinecraftVersions) | **GET** /minecraft/version | Get Minecraft Versions |
| [**getSpecificMinecraftModLoader()**](MinecraftApi.md#getSpecificMinecraftModLoader) | **GET** /minecraft/modloader/{modLoaderName} | Get Specific Minecraft ModLoader |
| [**getSpecificMinecraftVersion()**](MinecraftApi.md#getSpecificMinecraftVersion) | **GET** /minecraft/version/{gameVersionString} | Get Specific Minecraft Version |


## `getMinecraftModLoaders()`

```php
getMinecraftModLoaders($version, $include_all): \Aternos\CurseForgeApi\Model\ApiResponseOfListOfMinecraftModLoaderIndex
```

Get Minecraft ModLoaders

Get Minecraft ModLoaders

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\MinecraftApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$version = 'version_example'; // string
$include_all = True; // bool

try {
    $result = $apiInstance->getMinecraftModLoaders($version, $include_all);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MinecraftApi->getMinecraftModLoaders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **version** | **string**|  | [optional] |
| **include_all** | **bool**|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\ApiResponseOfListOfMinecraftModLoaderIndex**](../Model/ApiResponseOfListOfMinecraftModLoaderIndex.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getMinecraftVersions()`

```php
getMinecraftVersions($sort_descending): \Aternos\CurseForgeApi\Model\ApiResponseOfListOfMinecraftGameVersion
```

Get Minecraft Versions

Get Minecraft Versions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\MinecraftApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$sort_descending = True; // bool

try {
    $result = $apiInstance->getMinecraftVersions($sort_descending);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MinecraftApi->getMinecraftVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sort_descending** | **bool**|  | [optional] |

### Return type

[**\Aternos\CurseForgeApi\Model\ApiResponseOfListOfMinecraftGameVersion**](../Model/ApiResponseOfListOfMinecraftGameVersion.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSpecificMinecraftModLoader()`

```php
getSpecificMinecraftModLoader($mod_loader_name): \Aternos\CurseForgeApi\Model\ApiResponseOfMinecraftModLoaderVersion
```

Get Specific Minecraft ModLoader

Get Specific Minecraft ModLoader

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\MinecraftApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$mod_loader_name = 'mod_loader_name_example'; // string

try {
    $result = $apiInstance->getSpecificMinecraftModLoader($mod_loader_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MinecraftApi->getSpecificMinecraftModLoader: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mod_loader_name** | **string**|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\ApiResponseOfMinecraftModLoaderVersion**](../Model/ApiResponseOfMinecraftModLoaderVersion.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSpecificMinecraftVersion()`

```php
getSpecificMinecraftVersion($game_version_string): \Aternos\CurseForgeApi\Model\ApiResponseOfMinecraftGameVersion
```

Get Specific Minecraft Version

Get Specific Minecraft Version

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\CurseForgeApi\Api\MinecraftApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$game_version_string = 'game_version_string_example'; // string

try {
    $result = $apiInstance->getSpecificMinecraftVersion($game_version_string);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MinecraftApi->getSpecificMinecraftVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **game_version_string** | **string**|  | |

### Return type

[**\Aternos\CurseForgeApi\Model\ApiResponseOfMinecraftGameVersion**](../Model/ApiResponseOfMinecraftGameVersion.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
