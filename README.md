# Aternos/php-curseforge-api
An API client for the CurseForge API written in PHP. This client is a combination of code
generated by OpenAPI Generator using our [openapi spec](./openapi.yaml) and some wrappers
around it to improve the usability.

The generated code can be found in `lib/Api` and `lib/Model`. It is recommended to use the
wrappers in `lib/Client` instead of the generated code.

## Installation
Install the package via composer:
```bash
composer require aternos/curseforge-api
```

## Usage

The main entry point for the API is the `CurseForgeAPIClient` class.
```php
<?php
use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
$client = new CurseForgeAPIClient("api-key");

// set a user agent (recommended)
$client->setUserAgent('aternos/php-curseforge-api-example');
```
**You need an API key to use this client.** If you're a third party you can read more
about how to get one [here](https://support.curseforge.com/en/support/solutions/articles/9000208346).

## Paginated Lists
Most methods return a paginated list containing a list of results on the current page and methods to
navigate to the next and previous page. The paginated list implements `Iterator`, `ArrayAccess` and `Countable` so
you can use it like an array. It also has a `getResults()` method that returns the underlying array of results.

## Games
The `getGames` method for example returns a paginated list of games.
```php
$games = $client->getGames();

foreach ($games as $game) {
    // like most other methods, this method returns a wrapper
    // you can use the getData() method to get the game data
    echo $game->getData()->getName() . PHP_EOL;
}

$games = $games->getNextPage();

foreach ($games as $game) {
    echo $game->getData()->getName() . PHP_EOL;
}
```
You can also call `getGame` with the ID of a game to get a specific game. For example, 432 is the ID for Minecraft.
```php
$game = $client->getGame(432);
echo $game->getData()->getSlug() . PHP_EOL;
```

### Game Versions
A game contains various different version types, you can fetch them like this:
```php
$versionTypes = $client->getGameVersionTypes(432);
// or
$versionTypes = $game->getVersionTypes();
```
Since this endpoint isn't paginated, it returns an array instead of a paginated list.

You can also fetch the versions of a specific version type:
```php
$versions = $client->getGameVersionTypeVersions(432, 68441);
// or
$versionType = $versionTypes[0];
$versions = $versionType->getVersions();
```
For example: 68441 is the mod loader selection for Minecraft.

You can also get all versions for all version types of a game:
```php
$versions = $client->getGameVersions(432);
// or
$versions = $game->getVersions();
```

### Game Categories
A Game on CurseForge has category classes and categories.
Category classes are like "Modpacks" or "Plugins" and categories are like "World Generation" or "Chat".
You can fetch them like this:
```php
$categoryClasses = $client->getCategories(432);
// or
$categoryClasses = $game->getCategories();
```
Note that this will return both, category classes AND categories.

If you want to get only the category classes you can set the parameter `onlyClasses` to `true`:
```php
$categoryClasses = $client->getCategories(432, null, true);
// or
$categoryClasses = $game->getCategories(null, true);
```

You can fetch categories in a class using the parameter `classId`:
```php
$categories = $client->getCategories(432, 6);
// or
$categories = $game->getCategories(6);
```

## Mods
You can search mods like this:
```php
$options = new ModSearchOptions(432); // the game ID is required
$mods = $this->apiClient->searchMods($options);
// or
$mods = $game->searchMods(); // options are optional here
```

You can also get a list of featured mods for a game:
```php
$mods = $client->getFeaturedMods(432);
// or
$mods = $game->getFeaturedMods();

$featured = $mods->getFeatured();
$popular = $mods->getPopular();
$recentlyUpdated = $mods->getRecentlyUpdated();
```

You can fetch an individual mod by its ID like this:
```php
$mod = $client->getMod(420561);
```
or multiple mods in bulk
```php
$mods = $client->getMods([420561, 278568, 715033]);
```

You can also fetch the HTML for mod descriptions:
```php
$description = $mod->getDescription();
```

### Mod Files
To fetch mod files use the method `getFiles()`:
```php
$files = $mod->getFiles();
```
It optionally takes a ModFilesOptions object as a parameter:
```php
$options = new ModFilesOptions($mod->getData()->getId());
$options->setGameVersion("1.19.2");

use \Aternos\CurseForgeApi\Client\Options\ModSearch\ModLoaderType;
$options->setModLoaderType(ModLoaderType::FORGE);
```

There also is a method for this in the client, so you don't have to fetch the mod first:
```php
$options = new ModFilesOptions(420561);
$options->setGameVersion("1.19.2");
$options->setModLoaderType(ModLoaderType::FORGE);
$files = $client->getModFiles($options);
```
In this case the options are not optional as the mod id is required.

Just like with mods, you can fetch files individually or in bulk:
```php
$file = $client->getModFile(420561, 3787455);
// or
$files = $client->getModFiles([3787455, 3787456]);
```
Note that the bulk endpoint doesn't require a mod id.

#### File Download URLs
You can get the download URL for a file like this:
```php
$url = $file->getData()->getDownloadUrl();
// or if you don't already have the file object
$url = $client->getModFileDownloadUrl(420561, 3787455);
```
However, this will be null (in the first example) or a 403 error (in the second example)
if the mod does not allow [project distribution](https://support.curseforge.com/en/support/solutions/articles/9000207877).

## Fingerprints
You can search files on CurseForge by their fingerprint.
For example, this can be used to find the download source for a mod that is installed on a server.
CurseForge uses a variant of Murmur2 hashing with seed 1 for these fingerprints.

### Obtaining fingerprints
From the API:
```php
$file = $client->getModFile(420561, 3787455);
$fingerprint = $file->getFileFingerprint();
```

From a raw string using our CursedFingerprintHelper class:
```php
$fingerprint = CursedFingerprintHelper::getFingerprint("foo");
```

From a local file using our helper class:
```php
$fingerprint = CursedFingerprintHelper::getFingerprintFromFile("/path/to/file.jar");
```
This will read the file in chunks and calculate the fingerprint from that.

From any source using our helper class:
```php
$helper = new CursedFingerprintHelper($length);

while ($source->hasNextChunk()) {
    $helper->nextChunk($source->getNextChunk());
}

$fingerprint = $helper->finalize();
```
Note that the length field has to exclude whitespaces (\x09, \x0a, \x0d, \x20).
You can use the `stripWhiteSpcaes` or `isWhiteSpaceCharacter` methods to do that.

### Obtaining matches
```php
$files = $client->getFilesByFingerPrintMatches([1949504940, 1177254054]);
foreach ($files as $file) {
    echo $file->getFile()->getDisplayName() . PHP_EOL;
}
```

## Minecraft
There are a few Minecraft specific API endpoints as well:

```php
// Get Minecraft versions
$versions = $client->getMinecraftVersions();

// Get a specific version
$version = $client->getMinecraftVersion("1.19.2");

// Get mod loader versions
$modLoaders = $client->getMinecraftModLoaders();
$modLoaders = $client->getMinecraftModLoaders("1.19.2"); // optionally provide a Minecraft version
$modLoaders = $client->getMinecraftModLoaders(null, true); // show all loaders, including fabric

// get more information about a mod loader version
$version = $client->getMinecraftModLoader("forge-43.2.8");
```


## Updating the generated code
The generated code can be updated by installing the [openapi generator](https://openapi-generator.tech/docs/installation) running the following command:
```bash
openapi-generator-cli generate -c config.yaml
```
