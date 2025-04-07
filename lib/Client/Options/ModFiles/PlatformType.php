<?php

namespace Aternos\CurseForgeApi\Client\Options\ModFiles;

enum PlatformType: int
{
    case EMPTY = 0;
    case WINDOWS = 1;
    case XBOX_ONE = 2;
    case XBOX_XS = 3;
    case LINUX = 4;
    case PS4 = 5;
    case PS5 = 6;
    case MAC = 7;
    case IOS = 8;
    case TVOS = 9;
    case ANDROID = 10;
    case SWITCH = 11;
    case WINDOWS_SERVER = 12;
    case LINUX_SERVER = 13;
}
