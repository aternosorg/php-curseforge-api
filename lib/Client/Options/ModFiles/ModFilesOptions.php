<?php

namespace Aternos\CurseForgeApi\Client\Options\ModFiles;

use Aternos\CurseForgeApi\Client\Options\ModSearch\ModLoaderType;

class ModFilesOptions
{
    public function __construct(
        protected int            $modId,
        protected ?string        $gameVersion = null,
        protected ?ModLoaderType $modLoaderType = null,
        protected ?int           $gameVersionTypeId = null,
        protected int            $offset = 0,
        protected int            $pageSize = 50,
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
     */
    public function setModId(int $modId): void
    {
        $this->modId = $modId;
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
     */
    public function setGameVersion(?string $gameVersion): void
    {
        $this->gameVersion = $gameVersion;
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
     */
    public function setModLoaderType(?ModLoaderType $modLoaderType): void
    {
        $this->modLoaderType = $modLoaderType;
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
     */
    public function setGameVersionTypeId(?int $gameVersionTypeId): void
    {
        $this->gameVersionTypeId = $gameVersionTypeId;
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
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
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
     */
    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }
}