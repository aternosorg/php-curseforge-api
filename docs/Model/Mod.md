# # Mod

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The mod id | [optional]
**game_id** | **int** | The game id this mod is for | [optional]
**name** | **string** | The name of the mod | [optional]
**slug** | **string** | The mod slug that would appear in the URL | [optional]
**links** | [**\Aternos\CurseForgeApi\Model\ModLinks**](ModLinks.md) |  | [optional]
**summary** | **string** | Mod summary | [optional]
**status** | [**\Aternos\CurseForgeApi\Model\ModStatus**](ModStatus.md) |  | [optional]
**download_count** | **int** | Number of downloads for the mod | [optional]
**is_featured** | **mixed** | Whether the mod is included in the featured mods list | [optional]
**primary_category_id** | **int** | The main category of the mod as it was chosen by the mod author | [optional]
**categories** | [**\Aternos\CurseForgeApi\Model\Category[]**](Category.md) | List of categories that this mod is related to | [optional]
**class_id** | **int** | The class id this mod belongs to | [optional]
**authors** | [**\Aternos\CurseForgeApi\Model\ModAuthor[]**](ModAuthor.md) | List of the mod&#39;s authors | [optional]
**logo** | [**\Aternos\CurseForgeApi\Model\ModAsset**](ModAsset.md) |  | [optional]
**screenshots** | [**\Aternos\CurseForgeApi\Model\ModAsset[]**](ModAsset.md) | List of screenshots assets | [optional]
**main_file_id** | **int** | The id of the main file of the mod | [optional]
**latest_files** | [**\Aternos\CurseForgeApi\Model\File[]**](File.md) | List of latest files of the mod | [optional]
**latest_file_indexes** | [**\Aternos\CurseForgeApi\Model\FileIndex[]**](FileIndex.md) | List of file related details for the latest files of the mod | [optional]
**date_created** | **\DateTime** | The creation date of the mod | [optional]
**date_modified** | **\DateTime** | The last time the mod was modified | [optional]
**date_released** | **\DateTime** | The release date of the mod | [optional]
**allow_mod_distribution** | **bool** | Is mod allowed to be distributed | [optional]
**game_popularity_rank** | **int** | The mod popularity rank for the game | [optional]
**is_available** | **bool** | Is the mod available for search. This can be false when a mod is experimental, in a deleted state or has only alpha files | [optional]
**thumbs_up_count** | **int** | The mod&#39;s thumbs up count | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
