# # File

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The file id | [optional]
**game_id** | **int** | The game id related to the mod that this file belongs to | [optional]
**mod_id** | **int** | The mod id | [optional]
**is_available** | **bool** | Whether the file is available to download | [optional]
**display_name** | **string** | Display name of the file | [optional]
**file_name** | **string** | Exact file name | [optional]
**release_type** | [**\Aternos\CurseForgeApi\Model\FileReleaseType**](FileReleaseType.md) |  | [optional]
**file_status** | [**\Aternos\CurseForgeApi\Model\FileStatus**](FileStatus.md) |  | [optional]
**hashes** | [**\Aternos\CurseForgeApi\Model\FileHash[]**](FileHash.md) | The file hash (i.e. md5 or sha1) | [optional]
**file_date** | **\DateTime** | The file timestamp | [optional]
**file_length** | **int** | The file length in bytes | [optional]
**file_size_on_disk** | **int** | The file&#39;s size on disk | [optional]
**download_count** | **int** | The number of downloads for the file | [optional]
**download_url** | **string** |  | [optional]
**game_versions** | **string[]** | List of game versions this file is relevant for | [optional]
**sortable_game_versions** | [**\Aternos\CurseForgeApi\Model\SortableGameVersion[]**](SortableGameVersion.md) | Metadata used for sorting by game versions | [optional]
**dependencies** | [**\Aternos\CurseForgeApi\Model\FileDependency[]**](FileDependency.md) | List of dependencies files | [optional]
**expose_as_alternative** | **bool** |  | [optional]
**parent_project_file_id** | **int** |  | [optional]
**alternate_file_id** | **int** |  | [optional]
**is_server_pack** | **bool** |  | [optional]
**server_pack_file_id** | **int** |  | [optional]
**is_early_access_content** | **bool** |  | [optional]
**early_access_end_date** | **\DateTime** |  | [optional]
**file_fingerprint** | **int** |  | [optional]
**modules** | [**\Aternos\CurseForgeApi\Model\FileModule[]**](FileModule.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
