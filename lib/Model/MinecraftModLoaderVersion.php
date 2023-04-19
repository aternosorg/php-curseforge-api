<?php
/**
 * MinecraftModLoaderVersion
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
 * OpenAPI Generator version: 6.5.0
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
 * MinecraftModLoaderVersion Class Doc Comment
 *
 * @category Class
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MinecraftModLoaderVersion implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MinecraftModLoaderVersion';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'game_version_id' => 'int',
        'minecraft_game_version_id' => 'int',
        'forge_version' => 'string',
        'name' => 'string',
        'type' => '\Aternos\CurseForgeApi\Model\ModLoaderType',
        'download_url' => 'string',
        'filename' => 'string',
        'install_method' => '\Aternos\CurseForgeApi\Model\ModLoaderInstallMethod',
        'latest' => 'bool',
        'recommended' => 'bool',
        'approved' => 'bool',
        'date_modified' => '\DateTime',
        'maven_version_string' => 'string',
        'version_json' => 'string',
        'libraries_install_location' => 'string',
        'minecraft_version' => 'string',
        'additional_files_json' => 'string',
        'mod_loader_game_version_id' => 'int',
        'mod_loader_game_version_type_id' => 'int',
        'mod_loader_game_version_status' => '\Aternos\CurseForgeApi\Model\GameVersionStatus',
        'mod_loader_game_version_type_status' => '\Aternos\CurseForgeApi\Model\GameVersionTypeStatus',
        'mc_game_version_id' => 'int',
        'mc_game_version_type_id' => 'int',
        'mc_game_version_status' => '\Aternos\CurseForgeApi\Model\GameVersionStatus',
        'mc_game_version_type_status' => '\Aternos\CurseForgeApi\Model\GameVersionTypeStatus',
        'install_profile_json' => 'string'
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
        'game_version_id' => 'int32',
        'minecraft_game_version_id' => 'int32',
        'forge_version' => null,
        'name' => null,
        'type' => null,
        'download_url' => 'uri',
        'filename' => null,
        'install_method' => null,
        'latest' => null,
        'recommended' => null,
        'approved' => null,
        'date_modified' => 'date-time',
        'maven_version_string' => null,
        'version_json' => null,
        'libraries_install_location' => null,
        'minecraft_version' => null,
        'additional_files_json' => null,
        'mod_loader_game_version_id' => 'int32',
        'mod_loader_game_version_type_id' => 'int32',
        'mod_loader_game_version_status' => null,
        'mod_loader_game_version_type_status' => null,
        'mc_game_version_id' => 'int32',
        'mc_game_version_type_id' => 'int32',
        'mc_game_version_status' => null,
        'mc_game_version_type_status' => null,
        'install_profile_json' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'game_version_id' => false,
		'minecraft_game_version_id' => false,
		'forge_version' => false,
		'name' => false,
		'type' => false,
		'download_url' => false,
		'filename' => false,
		'install_method' => false,
		'latest' => false,
		'recommended' => false,
		'approved' => false,
		'date_modified' => false,
		'maven_version_string' => false,
		'version_json' => false,
		'libraries_install_location' => false,
		'minecraft_version' => false,
		'additional_files_json' => false,
		'mod_loader_game_version_id' => false,
		'mod_loader_game_version_type_id' => false,
		'mod_loader_game_version_status' => false,
		'mod_loader_game_version_type_status' => false,
		'mc_game_version_id' => false,
		'mc_game_version_type_id' => false,
		'mc_game_version_status' => false,
		'mc_game_version_type_status' => false,
		'install_profile_json' => false
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
        'game_version_id' => 'gameVersionId',
        'minecraft_game_version_id' => 'minecraftGameVersionId',
        'forge_version' => 'forgeVersion',
        'name' => 'name',
        'type' => 'type',
        'download_url' => 'downloadUrl',
        'filename' => 'filename',
        'install_method' => 'installMethod',
        'latest' => 'latest',
        'recommended' => 'recommended',
        'approved' => 'approved',
        'date_modified' => 'dateModified',
        'maven_version_string' => 'mavenVersionString',
        'version_json' => 'versionJson',
        'libraries_install_location' => 'librariesInstallLocation',
        'minecraft_version' => 'minecraftVersion',
        'additional_files_json' => 'additionalFilesJson',
        'mod_loader_game_version_id' => 'modLoaderGameVersionId',
        'mod_loader_game_version_type_id' => 'modLoaderGameVersionTypeId',
        'mod_loader_game_version_status' => 'modLoaderGameVersionStatus',
        'mod_loader_game_version_type_status' => 'modLoaderGameVersionTypeStatus',
        'mc_game_version_id' => 'mcGameVersionId',
        'mc_game_version_type_id' => 'mcGameVersionTypeId',
        'mc_game_version_status' => 'mcGameVersionStatus',
        'mc_game_version_type_status' => 'mcGameVersionTypeStatus',
        'install_profile_json' => 'installProfileJson'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'game_version_id' => 'setGameVersionId',
        'minecraft_game_version_id' => 'setMinecraftGameVersionId',
        'forge_version' => 'setForgeVersion',
        'name' => 'setName',
        'type' => 'setType',
        'download_url' => 'setDownloadUrl',
        'filename' => 'setFilename',
        'install_method' => 'setInstallMethod',
        'latest' => 'setLatest',
        'recommended' => 'setRecommended',
        'approved' => 'setApproved',
        'date_modified' => 'setDateModified',
        'maven_version_string' => 'setMavenVersionString',
        'version_json' => 'setVersionJson',
        'libraries_install_location' => 'setLibrariesInstallLocation',
        'minecraft_version' => 'setMinecraftVersion',
        'additional_files_json' => 'setAdditionalFilesJson',
        'mod_loader_game_version_id' => 'setModLoaderGameVersionId',
        'mod_loader_game_version_type_id' => 'setModLoaderGameVersionTypeId',
        'mod_loader_game_version_status' => 'setModLoaderGameVersionStatus',
        'mod_loader_game_version_type_status' => 'setModLoaderGameVersionTypeStatus',
        'mc_game_version_id' => 'setMcGameVersionId',
        'mc_game_version_type_id' => 'setMcGameVersionTypeId',
        'mc_game_version_status' => 'setMcGameVersionStatus',
        'mc_game_version_type_status' => 'setMcGameVersionTypeStatus',
        'install_profile_json' => 'setInstallProfileJson'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'game_version_id' => 'getGameVersionId',
        'minecraft_game_version_id' => 'getMinecraftGameVersionId',
        'forge_version' => 'getForgeVersion',
        'name' => 'getName',
        'type' => 'getType',
        'download_url' => 'getDownloadUrl',
        'filename' => 'getFilename',
        'install_method' => 'getInstallMethod',
        'latest' => 'getLatest',
        'recommended' => 'getRecommended',
        'approved' => 'getApproved',
        'date_modified' => 'getDateModified',
        'maven_version_string' => 'getMavenVersionString',
        'version_json' => 'getVersionJson',
        'libraries_install_location' => 'getLibrariesInstallLocation',
        'minecraft_version' => 'getMinecraftVersion',
        'additional_files_json' => 'getAdditionalFilesJson',
        'mod_loader_game_version_id' => 'getModLoaderGameVersionId',
        'mod_loader_game_version_type_id' => 'getModLoaderGameVersionTypeId',
        'mod_loader_game_version_status' => 'getModLoaderGameVersionStatus',
        'mod_loader_game_version_type_status' => 'getModLoaderGameVersionTypeStatus',
        'mc_game_version_id' => 'getMcGameVersionId',
        'mc_game_version_type_id' => 'getMcGameVersionTypeId',
        'mc_game_version_status' => 'getMcGameVersionStatus',
        'mc_game_version_type_status' => 'getMcGameVersionTypeStatus',
        'install_profile_json' => 'getInstallProfileJson'
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
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('game_version_id', $data ?? [], null);
        $this->setIfExists('minecraft_game_version_id', $data ?? [], null);
        $this->setIfExists('forge_version', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('download_url', $data ?? [], null);
        $this->setIfExists('filename', $data ?? [], null);
        $this->setIfExists('install_method', $data ?? [], null);
        $this->setIfExists('latest', $data ?? [], null);
        $this->setIfExists('recommended', $data ?? [], null);
        $this->setIfExists('approved', $data ?? [], null);
        $this->setIfExists('date_modified', $data ?? [], null);
        $this->setIfExists('maven_version_string', $data ?? [], null);
        $this->setIfExists('version_json', $data ?? [], null);
        $this->setIfExists('libraries_install_location', $data ?? [], null);
        $this->setIfExists('minecraft_version', $data ?? [], null);
        $this->setIfExists('additional_files_json', $data ?? [], null);
        $this->setIfExists('mod_loader_game_version_id', $data ?? [], null);
        $this->setIfExists('mod_loader_game_version_type_id', $data ?? [], null);
        $this->setIfExists('mod_loader_game_version_status', $data ?? [], null);
        $this->setIfExists('mod_loader_game_version_type_status', $data ?? [], null);
        $this->setIfExists('mc_game_version_id', $data ?? [], null);
        $this->setIfExists('mc_game_version_type_id', $data ?? [], null);
        $this->setIfExists('mc_game_version_status', $data ?? [], null);
        $this->setIfExists('mc_game_version_type_status', $data ?? [], null);
        $this->setIfExists('install_profile_json', $data ?? [], null);
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
     * @param int|null $id id
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
     * Gets game_version_id
     *
     * @return int|null
     */
    public function getGameVersionId()
    {
        return $this->container['game_version_id'];
    }

    /**
     * Sets game_version_id
     *
     * @param int|null $game_version_id game_version_id
     *
     * @return self
     */
    public function setGameVersionId($game_version_id)
    {
        if (is_null($game_version_id)) {
            throw new \InvalidArgumentException('non-nullable game_version_id cannot be null');
        }
        $this->container['game_version_id'] = $game_version_id;

        return $this;
    }

    /**
     * Gets minecraft_game_version_id
     *
     * @return int|null
     */
    public function getMinecraftGameVersionId()
    {
        return $this->container['minecraft_game_version_id'];
    }

    /**
     * Sets minecraft_game_version_id
     *
     * @param int|null $minecraft_game_version_id minecraft_game_version_id
     *
     * @return self
     */
    public function setMinecraftGameVersionId($minecraft_game_version_id)
    {
        if (is_null($minecraft_game_version_id)) {
            throw new \InvalidArgumentException('non-nullable minecraft_game_version_id cannot be null');
        }
        $this->container['minecraft_game_version_id'] = $minecraft_game_version_id;

        return $this;
    }

    /**
     * Gets forge_version
     *
     * @return string|null
     */
    public function getForgeVersion()
    {
        return $this->container['forge_version'];
    }

    /**
     * Sets forge_version
     *
     * @param string|null $forge_version forge_version
     *
     * @return self
     */
    public function setForgeVersion($forge_version)
    {
        if (is_null($forge_version)) {
            throw new \InvalidArgumentException('non-nullable forge_version cannot be null');
        }
        $this->container['forge_version'] = $forge_version;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets type
     *
     * @return \Aternos\CurseForgeApi\Model\ModLoaderType|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \Aternos\CurseForgeApi\Model\ModLoaderType|null $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $this->container['type'] = $type;

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
     * Gets filename
     *
     * @return string|null
     */
    public function getFilename()
    {
        return $this->container['filename'];
    }

    /**
     * Sets filename
     *
     * @param string|null $filename filename
     *
     * @return self
     */
    public function setFilename($filename)
    {
        if (is_null($filename)) {
            throw new \InvalidArgumentException('non-nullable filename cannot be null');
        }
        $this->container['filename'] = $filename;

        return $this;
    }

    /**
     * Gets install_method
     *
     * @return \Aternos\CurseForgeApi\Model\ModLoaderInstallMethod|null
     */
    public function getInstallMethod()
    {
        return $this->container['install_method'];
    }

    /**
     * Sets install_method
     *
     * @param \Aternos\CurseForgeApi\Model\ModLoaderInstallMethod|null $install_method install_method
     *
     * @return self
     */
    public function setInstallMethod($install_method)
    {
        if (is_null($install_method)) {
            throw new \InvalidArgumentException('non-nullable install_method cannot be null');
        }
        $this->container['install_method'] = $install_method;

        return $this;
    }

    /**
     * Gets latest
     *
     * @return bool|null
     */
    public function getLatest()
    {
        return $this->container['latest'];
    }

    /**
     * Sets latest
     *
     * @param bool|null $latest latest
     *
     * @return self
     */
    public function setLatest($latest)
    {
        if (is_null($latest)) {
            throw new \InvalidArgumentException('non-nullable latest cannot be null');
        }
        $this->container['latest'] = $latest;

        return $this;
    }

    /**
     * Gets recommended
     *
     * @return bool|null
     */
    public function getRecommended()
    {
        return $this->container['recommended'];
    }

    /**
     * Sets recommended
     *
     * @param bool|null $recommended recommended
     *
     * @return self
     */
    public function setRecommended($recommended)
    {
        if (is_null($recommended)) {
            throw new \InvalidArgumentException('non-nullable recommended cannot be null');
        }
        $this->container['recommended'] = $recommended;

        return $this;
    }

    /**
     * Gets approved
     *
     * @return bool|null
     */
    public function getApproved()
    {
        return $this->container['approved'];
    }

    /**
     * Sets approved
     *
     * @param bool|null $approved approved
     *
     * @return self
     */
    public function setApproved($approved)
    {
        if (is_null($approved)) {
            throw new \InvalidArgumentException('non-nullable approved cannot be null');
        }
        $this->container['approved'] = $approved;

        return $this;
    }

    /**
     * Gets date_modified
     *
     * @return \DateTime|null
     */
    public function getDateModified()
    {
        return $this->container['date_modified'];
    }

    /**
     * Sets date_modified
     *
     * @param \DateTime|null $date_modified date_modified
     *
     * @return self
     */
    public function setDateModified($date_modified)
    {
        if (is_null($date_modified)) {
            throw new \InvalidArgumentException('non-nullable date_modified cannot be null');
        }
        $this->container['date_modified'] = $date_modified;

        return $this;
    }

    /**
     * Gets maven_version_string
     *
     * @return string|null
     */
    public function getMavenVersionString()
    {
        return $this->container['maven_version_string'];
    }

    /**
     * Sets maven_version_string
     *
     * @param string|null $maven_version_string maven_version_string
     *
     * @return self
     */
    public function setMavenVersionString($maven_version_string)
    {
        if (is_null($maven_version_string)) {
            throw new \InvalidArgumentException('non-nullable maven_version_string cannot be null');
        }
        $this->container['maven_version_string'] = $maven_version_string;

        return $this;
    }

    /**
     * Gets version_json
     *
     * @return string|null
     */
    public function getVersionJson()
    {
        return $this->container['version_json'];
    }

    /**
     * Sets version_json
     *
     * @param string|null $version_json version_json
     *
     * @return self
     */
    public function setVersionJson($version_json)
    {
        if (is_null($version_json)) {
            throw new \InvalidArgumentException('non-nullable version_json cannot be null');
        }
        $this->container['version_json'] = $version_json;

        return $this;
    }

    /**
     * Gets libraries_install_location
     *
     * @return string|null
     */
    public function getLibrariesInstallLocation()
    {
        return $this->container['libraries_install_location'];
    }

    /**
     * Sets libraries_install_location
     *
     * @param string|null $libraries_install_location libraries_install_location
     *
     * @return self
     */
    public function setLibrariesInstallLocation($libraries_install_location)
    {
        if (is_null($libraries_install_location)) {
            throw new \InvalidArgumentException('non-nullable libraries_install_location cannot be null');
        }
        $this->container['libraries_install_location'] = $libraries_install_location;

        return $this;
    }

    /**
     * Gets minecraft_version
     *
     * @return string|null
     */
    public function getMinecraftVersion()
    {
        return $this->container['minecraft_version'];
    }

    /**
     * Sets minecraft_version
     *
     * @param string|null $minecraft_version minecraft_version
     *
     * @return self
     */
    public function setMinecraftVersion($minecraft_version)
    {
        if (is_null($minecraft_version)) {
            throw new \InvalidArgumentException('non-nullable minecraft_version cannot be null');
        }
        $this->container['minecraft_version'] = $minecraft_version;

        return $this;
    }

    /**
     * Gets additional_files_json
     *
     * @return string|null
     */
    public function getAdditionalFilesJson()
    {
        return $this->container['additional_files_json'];
    }

    /**
     * Sets additional_files_json
     *
     * @param string|null $additional_files_json additional_files_json
     *
     * @return self
     */
    public function setAdditionalFilesJson($additional_files_json)
    {
        if (is_null($additional_files_json)) {
            throw new \InvalidArgumentException('non-nullable additional_files_json cannot be null');
        }
        $this->container['additional_files_json'] = $additional_files_json;

        return $this;
    }

    /**
     * Gets mod_loader_game_version_id
     *
     * @return int|null
     */
    public function getModLoaderGameVersionId()
    {
        return $this->container['mod_loader_game_version_id'];
    }

    /**
     * Sets mod_loader_game_version_id
     *
     * @param int|null $mod_loader_game_version_id mod_loader_game_version_id
     *
     * @return self
     */
    public function setModLoaderGameVersionId($mod_loader_game_version_id)
    {
        if (is_null($mod_loader_game_version_id)) {
            throw new \InvalidArgumentException('non-nullable mod_loader_game_version_id cannot be null');
        }
        $this->container['mod_loader_game_version_id'] = $mod_loader_game_version_id;

        return $this;
    }

    /**
     * Gets mod_loader_game_version_type_id
     *
     * @return int|null
     */
    public function getModLoaderGameVersionTypeId()
    {
        return $this->container['mod_loader_game_version_type_id'];
    }

    /**
     * Sets mod_loader_game_version_type_id
     *
     * @param int|null $mod_loader_game_version_type_id mod_loader_game_version_type_id
     *
     * @return self
     */
    public function setModLoaderGameVersionTypeId($mod_loader_game_version_type_id)
    {
        if (is_null($mod_loader_game_version_type_id)) {
            throw new \InvalidArgumentException('non-nullable mod_loader_game_version_type_id cannot be null');
        }
        $this->container['mod_loader_game_version_type_id'] = $mod_loader_game_version_type_id;

        return $this;
    }

    /**
     * Gets mod_loader_game_version_status
     *
     * @return \Aternos\CurseForgeApi\Model\GameVersionStatus|null
     */
    public function getModLoaderGameVersionStatus()
    {
        return $this->container['mod_loader_game_version_status'];
    }

    /**
     * Sets mod_loader_game_version_status
     *
     * @param \Aternos\CurseForgeApi\Model\GameVersionStatus|null $mod_loader_game_version_status mod_loader_game_version_status
     *
     * @return self
     */
    public function setModLoaderGameVersionStatus($mod_loader_game_version_status)
    {
        if (is_null($mod_loader_game_version_status)) {
            throw new \InvalidArgumentException('non-nullable mod_loader_game_version_status cannot be null');
        }
        $this->container['mod_loader_game_version_status'] = $mod_loader_game_version_status;

        return $this;
    }

    /**
     * Gets mod_loader_game_version_type_status
     *
     * @return \Aternos\CurseForgeApi\Model\GameVersionTypeStatus|null
     */
    public function getModLoaderGameVersionTypeStatus()
    {
        return $this->container['mod_loader_game_version_type_status'];
    }

    /**
     * Sets mod_loader_game_version_type_status
     *
     * @param \Aternos\CurseForgeApi\Model\GameVersionTypeStatus|null $mod_loader_game_version_type_status mod_loader_game_version_type_status
     *
     * @return self
     */
    public function setModLoaderGameVersionTypeStatus($mod_loader_game_version_type_status)
    {
        if (is_null($mod_loader_game_version_type_status)) {
            throw new \InvalidArgumentException('non-nullable mod_loader_game_version_type_status cannot be null');
        }
        $this->container['mod_loader_game_version_type_status'] = $mod_loader_game_version_type_status;

        return $this;
    }

    /**
     * Gets mc_game_version_id
     *
     * @return int|null
     */
    public function getMcGameVersionId()
    {
        return $this->container['mc_game_version_id'];
    }

    /**
     * Sets mc_game_version_id
     *
     * @param int|null $mc_game_version_id mc_game_version_id
     *
     * @return self
     */
    public function setMcGameVersionId($mc_game_version_id)
    {
        if (is_null($mc_game_version_id)) {
            throw new \InvalidArgumentException('non-nullable mc_game_version_id cannot be null');
        }
        $this->container['mc_game_version_id'] = $mc_game_version_id;

        return $this;
    }

    /**
     * Gets mc_game_version_type_id
     *
     * @return int|null
     */
    public function getMcGameVersionTypeId()
    {
        return $this->container['mc_game_version_type_id'];
    }

    /**
     * Sets mc_game_version_type_id
     *
     * @param int|null $mc_game_version_type_id mc_game_version_type_id
     *
     * @return self
     */
    public function setMcGameVersionTypeId($mc_game_version_type_id)
    {
        if (is_null($mc_game_version_type_id)) {
            throw new \InvalidArgumentException('non-nullable mc_game_version_type_id cannot be null');
        }
        $this->container['mc_game_version_type_id'] = $mc_game_version_type_id;

        return $this;
    }

    /**
     * Gets mc_game_version_status
     *
     * @return \Aternos\CurseForgeApi\Model\GameVersionStatus|null
     */
    public function getMcGameVersionStatus()
    {
        return $this->container['mc_game_version_status'];
    }

    /**
     * Sets mc_game_version_status
     *
     * @param \Aternos\CurseForgeApi\Model\GameVersionStatus|null $mc_game_version_status mc_game_version_status
     *
     * @return self
     */
    public function setMcGameVersionStatus($mc_game_version_status)
    {
        if (is_null($mc_game_version_status)) {
            throw new \InvalidArgumentException('non-nullable mc_game_version_status cannot be null');
        }
        $this->container['mc_game_version_status'] = $mc_game_version_status;

        return $this;
    }

    /**
     * Gets mc_game_version_type_status
     *
     * @return \Aternos\CurseForgeApi\Model\GameVersionTypeStatus|null
     */
    public function getMcGameVersionTypeStatus()
    {
        return $this->container['mc_game_version_type_status'];
    }

    /**
     * Sets mc_game_version_type_status
     *
     * @param \Aternos\CurseForgeApi\Model\GameVersionTypeStatus|null $mc_game_version_type_status mc_game_version_type_status
     *
     * @return self
     */
    public function setMcGameVersionTypeStatus($mc_game_version_type_status)
    {
        if (is_null($mc_game_version_type_status)) {
            throw new \InvalidArgumentException('non-nullable mc_game_version_type_status cannot be null');
        }
        $this->container['mc_game_version_type_status'] = $mc_game_version_type_status;

        return $this;
    }

    /**
     * Gets install_profile_json
     *
     * @return string|null
     */
    public function getInstallProfileJson()
    {
        return $this->container['install_profile_json'];
    }

    /**
     * Sets install_profile_json
     *
     * @param string|null $install_profile_json install_profile_json
     *
     * @return self
     */
    public function setInstallProfileJson($install_profile_json)
    {
        if (is_null($install_profile_json)) {
            throw new \InvalidArgumentException('non-nullable install_profile_json cannot be null');
        }
        $this->container['install_profile_json'] = $install_profile_json;

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


