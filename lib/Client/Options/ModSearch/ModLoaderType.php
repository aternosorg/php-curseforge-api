<?php

namespace Aternos\CurseForgeApi\Client\Options\ModSearch;

enum ModLoaderType: int
{
    case ANY = 0;
    case FORGE = 1;
    case CAULDRON = 2;
    case LITE_LOADER = 3;
    case FABRIC = 4;
    case QUILT = 5;
}
