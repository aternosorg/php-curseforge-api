<?php
/**
 * RatingScore
 *
 * PHP version 8.1
 *
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
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.12.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\CurseForgeApi\Model;

/**
 * RatingScore Class Doc Comment
 *
 * @description * 0 &#x3D; NotEnoughReviews * 1 &#x3D; OverwhelminglyPositive * 2 &#x3D; VeryPositive * 3 &#x3D; Positive * 4 &#x3D; MostlyPositive * 5 &#x3D; Mixed * 6 &#x3D; MostlyNegative * 7 &#x3D; Negative * 8 &#x3D; VeryNegative * 9 &#x3D; OverwhelminglyNegative
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
enum RatingScore: int
{
    case NOT_ENOUGH_REVIEWS = 0;

    case OVERWHELMINGLY_POSITIVE = 1;

    case VERY_POSITIVE = 2;

    case POSITIVE = 3;

    case MOSTLY_POSITIVE = 4;

    case MIXED = 5;

    case MOSTLY_NEGATIVE = 6;

    case NEGATIVE = 7;

    case VERY_NEGATIVE = 8;

    case OVERWHELMINGLY_NEGATIVE = 9;
}


