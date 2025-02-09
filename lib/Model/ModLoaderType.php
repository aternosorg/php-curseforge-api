<?php
/**
 * ModLoaderType
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
use \Aternos\CurseForgeApi\ObjectSerializer;

/**
 * ModLoaderType Class Doc Comment
 *
 * @category Class
 * @description ModLoaderType Possible enum values:  * 0 &#x3D; Any  * 1 &#x3D; Forge  * 2 &#x3D; Cauldron  * 3 &#x3D; LiteLoader  * 4 &#x3D; Fabric  * 5 &#x3D; Quilt  * 6 &#x3D; NeoForge
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ModLoaderType
{
    /**
     * Possible values of this enum
     */
    public const NUMBER_0 = 0;

    public const NUMBER_1 = 1;

    public const NUMBER_2 = 2;

    public const NUMBER_3 = 3;

    public const NUMBER_4 = 4;

    public const NUMBER_5 = 5;

    public const NUMBER_6 = 6;

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NUMBER_0,
            self::NUMBER_1,
            self::NUMBER_2,
            self::NUMBER_3,
            self::NUMBER_4,
            self::NUMBER_5,
            self::NUMBER_6
        ];
    }
}


