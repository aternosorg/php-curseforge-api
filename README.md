# OpenAPIClient-php

HTTP API for CurseForge


## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## API Endpoints

All URIs are relative to *https://api.curseforge.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*CategoriesApi* | [**getCategories**](docs/Api/CategoriesApi.md#getcategories) | **GET** /categories | Get categories
*FilesApi* | [**getFiles**](docs/Api/FilesApi.md#getfiles) | **POST** /mods/files | Get files
*FilesApi* | [**getModFile**](docs/Api/FilesApi.md#getmodfile) | **GET** /mods/{modId}/files/{fileId} | Get mod file.
*FilesApi* | [**getModFileChangelog**](docs/Api/FilesApi.md#getmodfilechangelog) | **GET** /mods/{modId}/files/{fileId}/changelog | Get mod file changelog
*FilesApi* | [**getModFileDownloadURL**](docs/Api/FilesApi.md#getmodfiledownloadurl) | **GET** /mods/{modId}/files/{fileId}/download-url | Get Mod File Download URL
*FilesApi* | [**getModFiles**](docs/Api/FilesApi.md#getmodfiles) | **GET** /mods/{modId}/files | Get mod files.
*FingerprintsApi* | [**getFingerprintsFuzzyMatches**](docs/Api/FingerprintsApi.md#getfingerprintsfuzzymatches) | **POST** /fingerprints/fuzzy | Get Fingerprints Fuzzy Matches
*FingerprintsApi* | [**getFingerprintsMatches**](docs/Api/FingerprintsApi.md#getfingerprintsmatches) | **POST** /fingerprints | Get Fingerprints Matches
*GamesApi* | [**getGame**](docs/Api/GamesApi.md#getgame) | **GET** /games/{gameId} | Get game
*GamesApi* | [**getGames**](docs/Api/GamesApi.md#getgames) | **GET** /games | Get games
*GamesApi* | [**getVersionTypes**](docs/Api/GamesApi.md#getversiontypes) | **GET** /games/{gameId}/version-types | Get version types
*GamesApi* | [**getVersions**](docs/Api/GamesApi.md#getversions) | **GET** /games/{gameId}/versions | Get versions
*MinecraftApi* | [**getMinecraftModLoaders**](docs/Api/MinecraftApi.md#getminecraftmodloaders) | **GET** /minecraft/modloader | Get Minecraft ModLoaders
*MinecraftApi* | [**getMinecraftVersions**](docs/Api/MinecraftApi.md#getminecraftversions) | **GET** /minecraft/version | Get Minecraft Versions
*MinecraftApi* | [**getSpecificMinecraftModLoader**](docs/Api/MinecraftApi.md#getspecificminecraftmodloader) | **GET** /minecraft/modloader/{modLoaderName} | Get Specific Minecraft ModLoader
*MinecraftApi* | [**getSpecificMinecraftVersion**](docs/Api/MinecraftApi.md#getspecificminecraftversion) | **GET** /minecraft/version/{gameVersionString} | Get Specific Minecraft Version
*ModsApi* | [**getFeaturedMods**](docs/Api/ModsApi.md#getfeaturedmods) | **POST** /mods/featured | Get featured mods.
*ModsApi* | [**getMod**](docs/Api/ModsApi.md#getmod) | **GET** /mods/{modId} | Get a single mod.
*ModsApi* | [**getModDescription**](docs/Api/ModsApi.md#getmoddescription) | **GET** /mods/{modId}/description | Get mod description.
*ModsApi* | [**getMods**](docs/Api/ModsApi.md#getmods) | **POST** /mods | Get a list of mods.
*ModsApi* | [**searchMods**](docs/Api/ModsApi.md#searchmods) | **GET** /mods/search | Get all mods that match the search criteria.

## Models

- [ApiResponseOfListOfMinecraftGameVersion](docs/Model/ApiResponseOfListOfMinecraftGameVersion.md)
- [ApiResponseOfListOfMinecraftModLoaderIndex](docs/Model/ApiResponseOfListOfMinecraftModLoaderIndex.md)
- [ApiResponseOfMinecraftGameVersion](docs/Model/ApiResponseOfMinecraftGameVersion.md)
- [ApiResponseOfMinecraftModLoaderVersion](docs/Model/ApiResponseOfMinecraftModLoaderVersion.md)
- [Category](docs/Model/Category.md)
- [CoreApiStatus](docs/Model/CoreApiStatus.md)
- [CoreStatus](docs/Model/CoreStatus.md)
- [FeaturedModsResponse](docs/Model/FeaturedModsResponse.md)
- [File](docs/Model/File.md)
- [FileDependency](docs/Model/FileDependency.md)
- [FileHash](docs/Model/FileHash.md)
- [FileIndex](docs/Model/FileIndex.md)
- [FileModule](docs/Model/FileModule.md)
- [FileRelationType](docs/Model/FileRelationType.md)
- [FileReleaseType](docs/Model/FileReleaseType.md)
- [FileStatus](docs/Model/FileStatus.md)
- [FingerprintFuzzyMatch](docs/Model/FingerprintFuzzyMatch.md)
- [FingerprintFuzzyMatchResult](docs/Model/FingerprintFuzzyMatchResult.md)
- [FingerprintMatch](docs/Model/FingerprintMatch.md)
- [FingerprintsMatchesResult](docs/Model/FingerprintsMatchesResult.md)
- [FolderFingerprint](docs/Model/FolderFingerprint.md)
- [Game](docs/Model/Game.md)
- [GameAssets](docs/Model/GameAssets.md)
- [GameVersionStatus](docs/Model/GameVersionStatus.md)
- [GameVersionType](docs/Model/GameVersionType.md)
- [GameVersionTypeStatus](docs/Model/GameVersionTypeStatus.md)
- [GameVersionsByType](docs/Model/GameVersionsByType.md)
- [GetCategoriesResponse](docs/Model/GetCategoriesResponse.md)
- [GetFeaturedModsRequestBody](docs/Model/GetFeaturedModsRequestBody.md)
- [GetFeaturedModsResponse](docs/Model/GetFeaturedModsResponse.md)
- [GetFilesResponse](docs/Model/GetFilesResponse.md)
- [GetFingerprintMatchesRequestBody](docs/Model/GetFingerprintMatchesRequestBody.md)
- [GetFingerprintMatchesResponse](docs/Model/GetFingerprintMatchesResponse.md)
- [GetFingerprintsFuzzyMatchesResponse](docs/Model/GetFingerprintsFuzzyMatchesResponse.md)
- [GetFuzzyMatchesRequestBody](docs/Model/GetFuzzyMatchesRequestBody.md)
- [GetGameResponse](docs/Model/GetGameResponse.md)
- [GetGamesResponse](docs/Model/GetGamesResponse.md)
- [GetModFileChangelogResponse](docs/Model/GetModFileChangelogResponse.md)
- [GetModFileDownloadURLResponse](docs/Model/GetModFileDownloadURLResponse.md)
- [GetModFileResponse](docs/Model/GetModFileResponse.md)
- [GetModFilesRequestBody](docs/Model/GetModFilesRequestBody.md)
- [GetModFilesResponse](docs/Model/GetModFilesResponse.md)
- [GetModResponse](docs/Model/GetModResponse.md)
- [GetModsByIdsListRequestBody](docs/Model/GetModsByIdsListRequestBody.md)
- [GetModsResponse](docs/Model/GetModsResponse.md)
- [GetVersionTypesResponse](docs/Model/GetVersionTypesResponse.md)
- [GetVersionsResponse](docs/Model/GetVersionsResponse.md)
- [HashAlgo](docs/Model/HashAlgo.md)
- [MinecraftGameVersion](docs/Model/MinecraftGameVersion.md)
- [MinecraftModLoaderIndex](docs/Model/MinecraftModLoaderIndex.md)
- [MinecraftModLoaderVersion](docs/Model/MinecraftModLoaderVersion.md)
- [Mod](docs/Model/Mod.md)
- [ModAsset](docs/Model/ModAsset.md)
- [ModAuthor](docs/Model/ModAuthor.md)
- [ModDescriptionResponse](docs/Model/ModDescriptionResponse.md)
- [ModLinks](docs/Model/ModLinks.md)
- [ModLoaderInstallMethod](docs/Model/ModLoaderInstallMethod.md)
- [ModLoaderType](docs/Model/ModLoaderType.md)
- [ModStatus](docs/Model/ModStatus.md)
- [ModsSearchSortField](docs/Model/ModsSearchSortField.md)
- [Pagination](docs/Model/Pagination.md)
- [SearchModsResponse](docs/Model/SearchModsResponse.md)
- [SortOrder](docs/Model/SortOrder.md)
- [SortableGameVersion](docs/Model/SortableGameVersion.md)

## Authorization
All endpoints do not require authorization.
## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
    - Package version: `1.0.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
