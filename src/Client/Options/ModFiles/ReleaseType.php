<?php

namespace Aternos\CurseForgeApi\Client\Options\ModFiles;

enum ReleaseType: int
{
    case RELEASE = 1;
    case BETA = 2;
    case ALPHA = 3;
}
