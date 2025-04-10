<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client\Options;

use Aternos\CurseForgeApi\Client\Options\ModFilesOptions;
use Aternos\CurseForgeApi\Model\FileReleaseType;
use Aternos\CurseForgeApi\Model\ModLoaderType;
use Aternos\CurseForgeApi\Model\PlatformType;
use PHPUnit\Framework\TestCase;

class ModFilesOptionsTest extends TestCase
{
    public function testConstruct(): void
    {
        $options = new ModFilesOptions(1);
        $this->assertSame(1, $options->getModId());
        $this->assertSame(0, $options->getOffset());
        $this->assertSame(50, $options->getPageSize());
        $this->assertNull($options->getGameVersion());
        $this->assertNull($options->getModLoaderType());
        $this->assertNull($options->getGameVersionTypeId());
        $this->assertNull($options->getOlderThanProjectFileId());
        $this->assertNull($options->getReleaseTypes());
        $this->assertNull($options->getPlatformType());
    }

    public function testSetModId(): void
    {
        $options = new ModFilesOptions(1);
        $this->assertSame(1, $options->getModId());
        $options->setModId(2);
        $this->assertSame(2, $options->getModId());
    }

    public function testSetOffset(): void
    {
        $options = new ModFilesOptions(1, 10);
        $this->assertSame(10, $options->getOffset());
        $options->setOffset(20);
        $this->assertSame(20, $options->getOffset());
    }

    public function testSetPageSize(): void
    {
        $options = new ModFilesOptions(1, 0, 20);
        $this->assertSame(20, $options->getPageSize());
        $options->setPageSize(30);
        $this->assertSame(30, $options->getPageSize());
    }

    public function testSetGameVersion(): void
    {
        $options = new ModFilesOptions(1, gameVersion: "1.16.4");
        $this->assertSame("1.16.4", $options->getGameVersion());
        $options->setGameVersion("1.16.5");
        $this->assertSame("1.16.5", $options->getGameVersion());

        $options->setGameVersion(null);
        $this->assertNull($options->getGameVersion());
    }

    public function testSetModLoaderType(): void
    {
        $options = new ModFilesOptions(1, modLoaderType: ModLoaderType::FORGE);
        $this->assertSame(ModLoaderType::FORGE, $options->getModLoaderType());
        $options->setModLoaderType(ModLoaderType::FABRIC);
        $this->assertSame(ModLoaderType::FABRIC, $options->getModLoaderType());

        $options->setModLoaderType(null);
        $this->assertNull($options->getModLoaderType());
    }

    public function testSetGameVersionTypeId(): void
    {
        $options = new ModFilesOptions(1, gameVersionTypeId: 123);
        $this->assertSame(123, $options->getGameVersionTypeId());
        $options->setGameVersionTypeId(456);
        $this->assertSame(456, $options->getGameVersionTypeId());

        $options->setGameVersionTypeId(null);
        $this->assertNull($options->getGameVersionTypeId());
    }

    public function testSetOlderThanProjectFileId(): void
    {
        $options = new ModFilesOptions(1, olderThanProjectFileId: 123);
        $this->assertSame(123, $options->getOlderThanProjectFileId());
        $options->setOlderThanProjectFileId(456);
        $this->assertSame(456, $options->getOlderThanProjectFileId());

        $options->setOlderThanProjectFileId(null);
        $this->assertNull($options->getOlderThanProjectFileId());
    }

    public function testSetReleaseTypes(): void
    {
        $options = new ModFilesOptions(1, releaseTypes: [FileReleaseType::RELEASE, FileReleaseType::BETA]);
        $this->assertSame([FileReleaseType::RELEASE, FileReleaseType::BETA], $options->getReleaseTypes());
        $options->setReleaseTypes([FileReleaseType::BETA, FileReleaseType::ALPHA]);
        $this->assertSame([FileReleaseType::BETA, FileReleaseType::ALPHA], $options->getReleaseTypes());

        $options->setReleaseTypes(null);
        $this->assertNull($options->getReleaseTypes());
    }

    public function testAddReleaseType(): void
    {
        $options = new ModFilesOptions(1);
        $this->assertNull($options->getReleaseTypes());
        $options->addReleaseType(FileReleaseType::RELEASE);
        $this->assertSame([FileReleaseType::RELEASE], $options->getReleaseTypes());
        $options->addReleaseType(FileReleaseType::BETA);
        $this->assertSame([FileReleaseType::RELEASE, FileReleaseType::BETA], $options->getReleaseTypes());
    }

    public function testRemoveReleaseType(): void
    {
        $options = new ModFilesOptions(1, releaseTypes: [FileReleaseType::RELEASE, FileReleaseType::BETA]);
        $this->assertSame([FileReleaseType::RELEASE, FileReleaseType::BETA], $options->getReleaseTypes());
        $options->removeReleaseType(FileReleaseType::RELEASE);
        $this->assertSame([FileReleaseType::BETA], $options->getReleaseTypes());
        $options->removeReleaseType(FileReleaseType::BETA);
        $this->assertEquals([], $options->getReleaseTypes());
    }

    public function testSetPlatformType(): void
    {
        $options = new ModFilesOptions(1, platformType: PlatformType::WINDOWS);
        $this->assertSame(PlatformType::WINDOWS, $options->getPlatformType());
        $options->setPlatformType(PlatformType::LINUX);
        $this->assertSame(PlatformType::LINUX, $options->getPlatformType());

        $options->setPlatformType(null);
        $this->assertNull($options->getPlatformType());
    }
}
