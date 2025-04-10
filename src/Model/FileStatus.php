<?php
/**
 * FileStatus
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
 * FileStatus Class Doc Comment
 *
 * @description Status of the file Possible enum values:  * 1 &#x3D; Processing  * 2 &#x3D; ChangesRequired  * 3 &#x3D; UnderReview  * 4 &#x3D; Approved  * 5 &#x3D; Rejected  * 6 &#x3D; MalwareDetected  * 7 &#x3D; Deleted  * 8 &#x3D; Archived  * 9 &#x3D; Testing  * 10 &#x3D; Released  * 11 &#x3D; ReadyForReview  * 12 &#x3D; Deprecated  * 13 &#x3D; Baking  * 14 &#x3D; AwaitingPublishing  * 15 &#x3D; FailedPublishing  * 16 &#x3D; Cooking  * 17 &#x3D; Cooked  * 18 &#x3D; UnderManualReview  * 19 &#x3D; ScanningForMalware  * 20 &#x3D; ProcessingFile  * 21 &#x3D; PendingRelease  * 22 &#x3D; ReadyForCooking  * 23 &#x3D; PostProcessing
 * @package  Aternos\CurseForgeApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
enum FileStatus: int
{
    case PROCESSING = 1;

    case CHANGES_REQUIRED = 2;

    case UNDER_REVIEW = 3;

    case APPROVED = 4;

    case REJECTED = 5;

    case MALWARE_DETECTED = 6;

    case DELETED = 7;

    case ARCHIVED = 8;

    case TESTING = 9;

    case RELEASED = 10;

    case READY_FOR_REVIEW = 11;

    case DEPRECATED = 12;

    case BAKING = 13;

    case AWAITING_PUBLISHING = 14;

    case FAILED_PUBLISHING = 15;

    case COOKING = 16;

    case COOKED = 17;

    case UNDER_MANUAL_REVIEW = 18;

    case SCANNING_FOR_MALWARE = 19;

    case PROCESSING_FILE = 20;

    case PENDING_RELEASE = 21;

    case READY_FOR_COOKING = 22;

    case POST_PROCESSING = 23;
}


