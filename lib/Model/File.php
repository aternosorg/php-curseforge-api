<?php
/**
 * File
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * CurseForge API
 *
 * HTTP API for CurseForge
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.11.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\CurseForgeApi\Model;

use \ArrayAccess;
use \Aternos\CurseForgeApi\ObjectSerializer;

/**
 * File Class Doc Comment
 *
 * @category Class
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class File implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'File';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'game_id' => 'int',
        'mod_id' => 'int',
        'is_available' => 'bool',
        'display_name' => 'string',
        'file_name' => 'string',
        'release_type' => '\Aternos\CurseForgeApi\Model\FileReleaseType',
        'file_status' => '\Aternos\CurseForgeApi\Model\FileStatus',
        'hashes' => '\Aternos\CurseForgeApi\Model\FileHash[]',
        'file_date' => '\DateTime',
        'file_length' => 'int',
        'download_count' => 'int',
        'download_url' => 'string',
        'game_versions' => 'string[]',
        'sortable_game_versions' => '\Aternos\CurseForgeApi\Model\SortableGameVersion[]',
        'dependencies' => '\Aternos\CurseForgeApi\Model\FileDependency[]',
        'expose_as_alternative' => 'bool',
        'parent_project_file_id' => 'int',
        'alternate_file_id' => 'int',
        'is_server_pack' => 'bool',
        'server_pack_file_id' => 'int',
        'is_early_access_content' => 'bool',
        'early_access_end_date' => '\DateTime',
        'file_fingerprint' => 'int',
        'modules' => '\Aternos\CurseForgeApi\Model\FileModule[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => 'int32',
        'game_id' => 'int32',
        'mod_id' => 'int32',
        'is_available' => null,
        'display_name' => null,
        'file_name' => null,
        'release_type' => null,
        'file_status' => null,
        'hashes' => null,
        'file_date' => 'date-time',
        'file_length' => 'int64',
        'download_count' => 'int64',
        'download_url' => 'uri',
        'game_versions' => null,
        'sortable_game_versions' => null,
        'dependencies' => null,
        'expose_as_alternative' => null,
        'parent_project_file_id' => 'int32',
        'alternate_file_id' => 'int32',
        'is_server_pack' => null,
        'server_pack_file_id' => 'int32',
        'is_early_access_content' => null,
        'early_access_end_date' => 'date-time',
        'file_fingerprint' => 'int64',
        'modules' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'game_id' => false,
        'mod_id' => false,
        'is_available' => false,
        'display_name' => false,
        'file_name' => false,
        'release_type' => false,
        'file_status' => false,
        'hashes' => false,
        'file_date' => false,
        'file_length' => false,
        'download_count' => false,
        'download_url' => false,
        'game_versions' => false,
        'sortable_game_versions' => false,
        'dependencies' => false,
        'expose_as_alternative' => true,
        'parent_project_file_id' => true,
        'alternate_file_id' => true,
        'is_server_pack' => true,
        'server_pack_file_id' => true,
        'is_early_access_content' => true,
        'early_access_end_date' => true,
        'file_fingerprint' => false,
        'modules' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'game_id' => 'gameId',
        'mod_id' => 'modId',
        'is_available' => 'isAvailable',
        'display_name' => 'displayName',
        'file_name' => 'fileName',
        'release_type' => 'releaseType',
        'file_status' => 'fileStatus',
        'hashes' => 'hashes',
        'file_date' => 'fileDate',
        'file_length' => 'fileLength',
        'download_count' => 'downloadCount',
        'download_url' => 'downloadUrl',
        'game_versions' => 'gameVersions',
        'sortable_game_versions' => 'sortableGameVersions',
        'dependencies' => 'dependencies',
        'expose_as_alternative' => 'exposeAsAlternative',
        'parent_project_file_id' => 'parentProjectFileId',
        'alternate_file_id' => 'alternateFileId',
        'is_server_pack' => 'isServerPack',
        'server_pack_file_id' => 'serverPackFileId',
        'is_early_access_content' => 'isEarlyAccessContent',
        'early_access_end_date' => 'earlyAccessEndDate',
        'file_fingerprint' => 'fileFingerprint',
        'modules' => 'modules'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'game_id' => 'setGameId',
        'mod_id' => 'setModId',
        'is_available' => 'setIsAvailable',
        'display_name' => 'setDisplayName',
        'file_name' => 'setFileName',
        'release_type' => 'setReleaseType',
        'file_status' => 'setFileStatus',
        'hashes' => 'setHashes',
        'file_date' => 'setFileDate',
        'file_length' => 'setFileLength',
        'download_count' => 'setDownloadCount',
        'download_url' => 'setDownloadUrl',
        'game_versions' => 'setGameVersions',
        'sortable_game_versions' => 'setSortableGameVersions',
        'dependencies' => 'setDependencies',
        'expose_as_alternative' => 'setExposeAsAlternative',
        'parent_project_file_id' => 'setParentProjectFileId',
        'alternate_file_id' => 'setAlternateFileId',
        'is_server_pack' => 'setIsServerPack',
        'server_pack_file_id' => 'setServerPackFileId',
        'is_early_access_content' => 'setIsEarlyAccessContent',
        'early_access_end_date' => 'setEarlyAccessEndDate',
        'file_fingerprint' => 'setFileFingerprint',
        'modules' => 'setModules'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'game_id' => 'getGameId',
        'mod_id' => 'getModId',
        'is_available' => 'getIsAvailable',
        'display_name' => 'getDisplayName',
        'file_name' => 'getFileName',
        'release_type' => 'getReleaseType',
        'file_status' => 'getFileStatus',
        'hashes' => 'getHashes',
        'file_date' => 'getFileDate',
        'file_length' => 'getFileLength',
        'download_count' => 'getDownloadCount',
        'download_url' => 'getDownloadUrl',
        'game_versions' => 'getGameVersions',
        'sortable_game_versions' => 'getSortableGameVersions',
        'dependencies' => 'getDependencies',
        'expose_as_alternative' => 'getExposeAsAlternative',
        'parent_project_file_id' => 'getParentProjectFileId',
        'alternate_file_id' => 'getAlternateFileId',
        'is_server_pack' => 'getIsServerPack',
        'server_pack_file_id' => 'getServerPackFileId',
        'is_early_access_content' => 'getIsEarlyAccessContent',
        'early_access_end_date' => 'getEarlyAccessEndDate',
        'file_fingerprint' => 'getFileFingerprint',
        'modules' => 'getModules'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('game_id', $data ?? [], null);
        $this->setIfExists('mod_id', $data ?? [], null);
        $this->setIfExists('is_available', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('file_name', $data ?? [], null);
        $this->setIfExists('release_type', $data ?? [], null);
        $this->setIfExists('file_status', $data ?? [], null);
        $this->setIfExists('hashes', $data ?? [], null);
        $this->setIfExists('file_date', $data ?? [], null);
        $this->setIfExists('file_length', $data ?? [], null);
        $this->setIfExists('download_count', $data ?? [], null);
        $this->setIfExists('download_url', $data ?? [], null);
        $this->setIfExists('game_versions', $data ?? [], null);
        $this->setIfExists('sortable_game_versions', $data ?? [], null);
        $this->setIfExists('dependencies', $data ?? [], null);
        $this->setIfExists('expose_as_alternative', $data ?? [], null);
        $this->setIfExists('parent_project_file_id', $data ?? [], null);
        $this->setIfExists('alternate_file_id', $data ?? [], null);
        $this->setIfExists('is_server_pack', $data ?? [], null);
        $this->setIfExists('server_pack_file_id', $data ?? [], null);
        $this->setIfExists('is_early_access_content', $data ?? [], null);
        $this->setIfExists('early_access_end_date', $data ?? [], null);
        $this->setIfExists('file_fingerprint', $data ?? [], null);
        $this->setIfExists('modules', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id The file id
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets game_id
     *
     * @return int|null
     */
    public function getGameId()
    {
        return $this->container['game_id'];
    }

    /**
     * Sets game_id
     *
     * @param int|null $game_id The game id related to the mod that this file belongs to
     *
     * @return self
     */
    public function setGameId($game_id)
    {
        if (is_null($game_id)) {
            throw new \InvalidArgumentException('non-nullable game_id cannot be null');
        }
        $this->container['game_id'] = $game_id;

        return $this;
    }

    /**
     * Gets mod_id
     *
     * @return int|null
     */
    public function getModId()
    {
        return $this->container['mod_id'];
    }

    /**
     * Sets mod_id
     *
     * @param int|null $mod_id The mod id
     *
     * @return self
     */
    public function setModId($mod_id)
    {
        if (is_null($mod_id)) {
            throw new \InvalidArgumentException('non-nullable mod_id cannot be null');
        }
        $this->container['mod_id'] = $mod_id;

        return $this;
    }

    /**
     * Gets is_available
     *
     * @return bool|null
     */
    public function getIsAvailable()
    {
        return $this->container['is_available'];
    }

    /**
     * Sets is_available
     *
     * @param bool|null $is_available Whether the file is available to download
     *
     * @return self
     */
    public function setIsAvailable($is_available)
    {
        if (is_null($is_available)) {
            throw new \InvalidArgumentException('non-nullable is_available cannot be null');
        }
        $this->container['is_available'] = $is_available;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name Display name of the file
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets file_name
     *
     * @return string|null
     */
    public function getFileName()
    {
        return $this->container['file_name'];
    }

    /**
     * Sets file_name
     *
     * @param string|null $file_name Exact file name
     *
     * @return self
     */
    public function setFileName($file_name)
    {
        if (is_null($file_name)) {
            throw new \InvalidArgumentException('non-nullable file_name cannot be null');
        }
        $this->container['file_name'] = $file_name;

        return $this;
    }

    /**
     * Gets release_type
     *
     * @return \Aternos\CurseForgeApi\Model\FileReleaseType|null
     */
    public function getReleaseType()
    {
        return $this->container['release_type'];
    }

    /**
     * Sets release_type
     *
     * @param \Aternos\CurseForgeApi\Model\FileReleaseType|null $release_type release_type
     *
     * @return self
     */
    public function setReleaseType($release_type)
    {
        if (is_null($release_type)) {
            throw new \InvalidArgumentException('non-nullable release_type cannot be null');
        }
        $this->container['release_type'] = $release_type;

        return $this;
    }

    /**
     * Gets file_status
     *
     * @return \Aternos\CurseForgeApi\Model\FileStatus|null
     */
    public function getFileStatus()
    {
        return $this->container['file_status'];
    }

    /**
     * Sets file_status
     *
     * @param \Aternos\CurseForgeApi\Model\FileStatus|null $file_status file_status
     *
     * @return self
     */
    public function setFileStatus($file_status)
    {
        if (is_null($file_status)) {
            throw new \InvalidArgumentException('non-nullable file_status cannot be null');
        }
        $this->container['file_status'] = $file_status;

        return $this;
    }

    /**
     * Gets hashes
     *
     * @return \Aternos\CurseForgeApi\Model\FileHash[]|null
     */
    public function getHashes()
    {
        return $this->container['hashes'];
    }

    /**
     * Sets hashes
     *
     * @param \Aternos\CurseForgeApi\Model\FileHash[]|null $hashes The file hash (i.e. md5 or sha1)
     *
     * @return self
     */
    public function setHashes($hashes)
    {
        if (is_null($hashes)) {
            throw new \InvalidArgumentException('non-nullable hashes cannot be null');
        }
        $this->container['hashes'] = $hashes;

        return $this;
    }

    /**
     * Gets file_date
     *
     * @return \DateTime|null
     */
    public function getFileDate()
    {
        return $this->container['file_date'];
    }

    /**
     * Sets file_date
     *
     * @param \DateTime|null $file_date The file timestamp
     *
     * @return self
     */
    public function setFileDate($file_date)
    {
        if (is_null($file_date)) {
            throw new \InvalidArgumentException('non-nullable file_date cannot be null');
        }
        $this->container['file_date'] = $file_date;

        return $this;
    }

    /**
     * Gets file_length
     *
     * @return int|null
     */
    public function getFileLength()
    {
        return $this->container['file_length'];
    }

    /**
     * Sets file_length
     *
     * @param int|null $file_length The file length in bytes
     *
     * @return self
     */
    public function setFileLength($file_length)
    {
        if (is_null($file_length)) {
            throw new \InvalidArgumentException('non-nullable file_length cannot be null');
        }
        $this->container['file_length'] = $file_length;

        return $this;
    }

    /**
     * Gets download_count
     *
     * @return int|null
     */
    public function getDownloadCount()
    {
        return $this->container['download_count'];
    }

    /**
     * Sets download_count
     *
     * @param int|null $download_count The number of downloads for the file
     *
     * @return self
     */
    public function setDownloadCount($download_count)
    {
        if (is_null($download_count)) {
            throw new \InvalidArgumentException('non-nullable download_count cannot be null');
        }
        $this->container['download_count'] = $download_count;

        return $this;
    }

    /**
     * Gets download_url
     *
     * @return string|null
     */
    public function getDownloadUrl()
    {
        return $this->container['download_url'];
    }

    /**
     * Sets download_url
     *
     * @param string|null $download_url download_url
     *
     * @return self
     */
    public function setDownloadUrl($download_url)
    {
        if (is_null($download_url)) {
            throw new \InvalidArgumentException('non-nullable download_url cannot be null');
        }
        $this->container['download_url'] = $download_url;

        return $this;
    }

    /**
     * Gets game_versions
     *
     * @return string[]|null
     */
    public function getGameVersions()
    {
        return $this->container['game_versions'];
    }

    /**
     * Sets game_versions
     *
     * @param string[]|null $game_versions List of game versions this file is relevant for
     *
     * @return self
     */
    public function setGameVersions($game_versions)
    {
        if (is_null($game_versions)) {
            throw new \InvalidArgumentException('non-nullable game_versions cannot be null');
        }
        $this->container['game_versions'] = $game_versions;

        return $this;
    }

    /**
     * Gets sortable_game_versions
     *
     * @return \Aternos\CurseForgeApi\Model\SortableGameVersion[]|null
     */
    public function getSortableGameVersions()
    {
        return $this->container['sortable_game_versions'];
    }

    /**
     * Sets sortable_game_versions
     *
     * @param \Aternos\CurseForgeApi\Model\SortableGameVersion[]|null $sortable_game_versions Metadata used for sorting by game versions
     *
     * @return self
     */
    public function setSortableGameVersions($sortable_game_versions)
    {
        if (is_null($sortable_game_versions)) {
            throw new \InvalidArgumentException('non-nullable sortable_game_versions cannot be null');
        }
        $this->container['sortable_game_versions'] = $sortable_game_versions;

        return $this;
    }

    /**
     * Gets dependencies
     *
     * @return \Aternos\CurseForgeApi\Model\FileDependency[]|null
     */
    public function getDependencies()
    {
        return $this->container['dependencies'];
    }

    /**
     * Sets dependencies
     *
     * @param \Aternos\CurseForgeApi\Model\FileDependency[]|null $dependencies List of dependencies files
     *
     * @return self
     */
    public function setDependencies($dependencies)
    {
        if (is_null($dependencies)) {
            throw new \InvalidArgumentException('non-nullable dependencies cannot be null');
        }
        $this->container['dependencies'] = $dependencies;

        return $this;
    }

    /**
     * Gets expose_as_alternative
     *
     * @return bool|null
     */
    public function getExposeAsAlternative()
    {
        return $this->container['expose_as_alternative'];
    }

    /**
     * Sets expose_as_alternative
     *
     * @param bool|null $expose_as_alternative expose_as_alternative
     *
     * @return self
     */
    public function setExposeAsAlternative($expose_as_alternative)
    {
        if (is_null($expose_as_alternative)) {
            array_push($this->openAPINullablesSetToNull, 'expose_as_alternative');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('expose_as_alternative', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['expose_as_alternative'] = $expose_as_alternative;

        return $this;
    }

    /**
     * Gets parent_project_file_id
     *
     * @return int|null
     */
    public function getParentProjectFileId()
    {
        return $this->container['parent_project_file_id'];
    }

    /**
     * Sets parent_project_file_id
     *
     * @param int|null $parent_project_file_id parent_project_file_id
     *
     * @return self
     */
    public function setParentProjectFileId($parent_project_file_id)
    {
        if (is_null($parent_project_file_id)) {
            array_push($this->openAPINullablesSetToNull, 'parent_project_file_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('parent_project_file_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['parent_project_file_id'] = $parent_project_file_id;

        return $this;
    }

    /**
     * Gets alternate_file_id
     *
     * @return int|null
     */
    public function getAlternateFileId()
    {
        return $this->container['alternate_file_id'];
    }

    /**
     * Sets alternate_file_id
     *
     * @param int|null $alternate_file_id alternate_file_id
     *
     * @return self
     */
    public function setAlternateFileId($alternate_file_id)
    {
        if (is_null($alternate_file_id)) {
            array_push($this->openAPINullablesSetToNull, 'alternate_file_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('alternate_file_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['alternate_file_id'] = $alternate_file_id;

        return $this;
    }

    /**
     * Gets is_server_pack
     *
     * @return bool|null
     */
    public function getIsServerPack()
    {
        return $this->container['is_server_pack'];
    }

    /**
     * Sets is_server_pack
     *
     * @param bool|null $is_server_pack is_server_pack
     *
     * @return self
     */
    public function setIsServerPack($is_server_pack)
    {
        if (is_null($is_server_pack)) {
            array_push($this->openAPINullablesSetToNull, 'is_server_pack');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('is_server_pack', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['is_server_pack'] = $is_server_pack;

        return $this;
    }

    /**
     * Gets server_pack_file_id
     *
     * @return int|null
     */
    public function getServerPackFileId()
    {
        return $this->container['server_pack_file_id'];
    }

    /**
     * Sets server_pack_file_id
     *
     * @param int|null $server_pack_file_id server_pack_file_id
     *
     * @return self
     */
    public function setServerPackFileId($server_pack_file_id)
    {
        if (is_null($server_pack_file_id)) {
            array_push($this->openAPINullablesSetToNull, 'server_pack_file_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('server_pack_file_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['server_pack_file_id'] = $server_pack_file_id;

        return $this;
    }

    /**
     * Gets is_early_access_content
     *
     * @return bool|null
     */
    public function getIsEarlyAccessContent()
    {
        return $this->container['is_early_access_content'];
    }

    /**
     * Sets is_early_access_content
     *
     * @param bool|null $is_early_access_content is_early_access_content
     *
     * @return self
     */
    public function setIsEarlyAccessContent($is_early_access_content)
    {
        if (is_null($is_early_access_content)) {
            array_push($this->openAPINullablesSetToNull, 'is_early_access_content');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('is_early_access_content', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['is_early_access_content'] = $is_early_access_content;

        return $this;
    }

    /**
     * Gets early_access_end_date
     *
     * @return \DateTime|null
     */
    public function getEarlyAccessEndDate()
    {
        return $this->container['early_access_end_date'];
    }

    /**
     * Sets early_access_end_date
     *
     * @param \DateTime|null $early_access_end_date early_access_end_date
     *
     * @return self
     */
    public function setEarlyAccessEndDate($early_access_end_date)
    {
        if (is_null($early_access_end_date)) {
            array_push($this->openAPINullablesSetToNull, 'early_access_end_date');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('early_access_end_date', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['early_access_end_date'] = $early_access_end_date;

        return $this;
    }

    /**
     * Gets file_fingerprint
     *
     * @return int|null
     */
    public function getFileFingerprint()
    {
        return $this->container['file_fingerprint'];
    }

    /**
     * Sets file_fingerprint
     *
     * @param int|null $file_fingerprint file_fingerprint
     *
     * @return self
     */
    public function setFileFingerprint($file_fingerprint)
    {
        if (is_null($file_fingerprint)) {
            throw new \InvalidArgumentException('non-nullable file_fingerprint cannot be null');
        }
        $this->container['file_fingerprint'] = $file_fingerprint;

        return $this;
    }

    /**
     * Gets modules
     *
     * @return \Aternos\CurseForgeApi\Model\FileModule[]|null
     */
    public function getModules()
    {
        return $this->container['modules'];
    }

    /**
     * Sets modules
     *
     * @param \Aternos\CurseForgeApi\Model\FileModule[]|null $modules modules
     *
     * @return self
     */
    public function setModules($modules)
    {
        if (is_null($modules)) {
            throw new \InvalidArgumentException('non-nullable modules cannot be null');
        }
        $this->container['modules'] = $modules;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


