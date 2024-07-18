<?php

namespace Aternos\CurseForgeApi\Client\Options\ModFiles;

use Aternos\CurseForgeApi\Client\List\PaginatedFilesList;
use Aternos\CurseForgeApi\Client\Options\ModSearch\ModLoaderType;

class ModFilesOptions
{
    public function __construct(
        protected int            $modId,
        protected ?string        $gameVersion = null,
        protected ?ModLoaderType $modLoaderType = null,
        protected ?int           $gameVersionTypeId = null,
        protected int            $offset = 0,
        protected int            $pageSize = PaginatedFilesList::MAX_PAGE_SIZE,
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
}