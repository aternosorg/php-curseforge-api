<?php
/**
 * ModsSearchSortField
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
use \Aternos\CurseForgeApi\ObjectSerializer;

/**
 * ModsSearchSortField Class Doc Comment
 *
 * @category Class
 * @description Possible enum values:  * 1 &#x3D; Featured  * 2 &#x3D; Popularity  * 3 &#x3D; LastUpdated              * 4 &#x3D; Name  * 5 &#x3D; Author  * 6 &#x3D; TotalDownloads  * 7 &#x3D; Category  * 8 &#x3D; GameVersion
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ModsSearchSortField
{
    /**
     * Possible values of this enum
     */
    public const NUMBER_1 = 1;

    public const NUMBER_2 = 2;

    public const NUMBER_3 = 3;

    public const NUMBER_4 = 4;

    public const NUMBER_5 = 5;

    public const NUMBER_6 = 6;

    public const NUMBER_7 = 7;

    public const NUMBER_8 = 8;

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NUMBER_1,
            self::NUMBER_2,
            self::NUMBER_3,
            self::NUMBER_4,
            self::NUMBER_5,
            self::NUMBER_6,
            self::NUMBER_7,
            self::NUMBER_8
        ];
    }
}


