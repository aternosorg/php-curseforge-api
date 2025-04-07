<?php

namespace Aternos\CurseForgeApi\Client\Options\ModFiles;

use Aternos\CurseForgeApi\Client\List\PaginatedFilesList;
use Aternos\CurseForgeApi\Client\Options\ModSearch\ModLoaderType;

class ModFilesOptions
{
    /**
     * Create new options for filtering mod files
     * @param int $modId id of the mod to get files for
     * @param int $offset offset to start page at
     * @param int $pageSize number of files to return
     * @param string|null $gameVersion game version to filter files by
     * @param ModLoaderType|null $modLoaderType mod loader type to filter files by
     * @param int|null $gameVersionTypeId show only files that are tagged with versions of the given gameVersionTypeId
     * @param int|null $olderThanProjectFileId show only files that are older than the given projectFileId
     * @param ReleaseType[]|null $releaseTypes array of release types to filter files by
     * @param PlatformType|null $platformType platform type to filter files by
     */
    public function __construct(
        protected int            $modId,
        protected int            $offset = 0,
        protected int            $pageSize = PaginatedFilesList::MAX_PAGE_SIZE,
        protected ?string        $gameVersion = null,
        protected ?ModLoaderType $modLoaderType = null,
        protected ?int           $gameVersionTypeId = null,
        protected ?int           $olderThanProjectFileId = null,
        protected ?array         $releaseTypes = null,
        protected ?PlatformType  $platformType = null,
    )
    {
    }

    /**
     * @return int
     */
    public function getModId(): int
    {
        return $this->modId;
    }

    /**
     * @param int $modId
     * @return $this
     */
    public function setModId(int $modId): static
    {
        $this->modId = $modId;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset(int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return $this
     */
    public function setPageSize(int $pageSize): static
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGameVersion(): ?string
    {
        return $this->gameVersion;
    }

    /**
     * @param string|null $gameVersion
     * @return $this
     */
    public function setGameVersion(?string $gameVersion): static
    {
        $this->gameVersion = $gameVersion;
        return $this;
    }

    /**
     * @return ModLoaderType|null
     */
    public function getModLoaderType(): ?ModLoaderType
    {
        return $this->modLoaderType;
    }

    /**
     * @param ModLoaderType|null $modLoaderType
     * @return $this
     */
    public function setModLoaderType(?ModLoaderType $modLoaderType): static
    {
        $this->modLoaderType = $modLoaderType;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGameVersionTypeId(): ?int
    {
        return $this->gameVersionTypeId;
    }

    /**
     * @param int|null $gameVersionTypeId
     * @return $this
     */
    public function setGameVersionTypeId(?int $gameVersionTypeId): static
    {
        $this->gameVersionTypeId = $gameVersionTypeId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOlderThanProjectFileId(): ?int
    {
        return $this->olderThanProjectFileId;
    }

    /**
     * @param int|null $olderThanProjectFileId
     * @return $this
     */
    public function setOlderThanProjectFileId(?int $olderThanProjectFileId): static
    {
        $this->olderThanProjectFileId = $olderThanProjectFileId;
        return $this;
    }

    /**
     * @return ReleaseType[]|null
     */
    public function getReleaseTypes(): ?array
    {
        return $this->releaseTypes;
    }

    /**
     * @param ReleaseType[]|null $releaseTypes
     * @return $this
     */
    public function setReleaseTypes(?array $releaseTypes): static
    {
        $this->releaseTypes = $releaseTypes;
        return $this;
    }

    /**
     * @param ReleaseType $releaseType
     * @return $this
     */
    public function addReleaseType(ReleaseType $releaseType): static
    {
        $this->releaseTypes ??= [];
        $this->releaseTypes[] = $releaseType;
        return $this;
    }

    /**
     * @param ReleaseType $releaseType
     * @return $this
     */
    public function removeReleaseType(ReleaseType $releaseType): static
    {
        $this->releaseTypes = array_filter($this->releaseTypes, fn($type) => $type !== $releaseType);
        return $this;
    }

    /**
     * @return PlatformType|null
     */
    public function getPlatformType(): ?PlatformType
    {
        return $this->platformType;
    }

    /**
     * @param PlatformType|null $platformType
     * @return $this
     */
    public function setPlatformType(?PlatformType $platformType): static
    {
        $this->platformType = $platformType;
        return $this;
    }
}
