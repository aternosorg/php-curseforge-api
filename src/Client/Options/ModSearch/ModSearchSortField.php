<?php

namespace Aternos\CurseForgeApi\Client\Options\ModSearch;

enum ModSearchSortField: int
{
    case FEATURED = 1;
    case POPULARITY = 2;
    case LAST_UPDATED = 3;
    case NAME = 4;
    case AUTHOR = 5;
    case TOTAL_DOWNLOADS = 6;
    case CATEGORY = 7;
    case GAME_VERSION = 8;
    case EARLY_ACCESS = 9;
    case FEATURED_RELEASE = 10;
    case RELEASE_DATE = 11;
    case RATING = 12;
}
