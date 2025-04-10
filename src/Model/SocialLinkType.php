<?php
/**
 * SocialLinkType
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
 * SocialLinkType Class Doc Comment
 *
 * @description * 1 &#x3D; Mastodon * 2 &#x3D; Discord * 3 &#x3D; Website * 4 &#x3D; Facebook * 5 &#x3D; Twitter * 6 &#x3D; Instagram * 7 &#x3D; Patreon * 8 &#x3D; Twitch * 9 &#x3D; Reddit * 10 &#x3D; Youtube * 11 &#x3D; TikTok * 12 &#x3D; Pinterest * 13 &#x3D; Github * 14 &#x3D; Bluesky
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
enum SocialLinkType: int
{
    case MASTODON = 1;

    case DISCORD = 2;

    case WEBSITE = 3;

    case FACEBOOK = 4;

    case TWITTER = 5;

    case INSTAGRAM = 6;

    case PATREON = 7;

    case TWITCH = 8;

    case REDDIT = 9;

    case YOUTUBE = 10;

    case TIK_TOK = 11;

    case PINTEREST = 12;

    case GITHUB = 13;

    case BLUESKY = 14;
}


