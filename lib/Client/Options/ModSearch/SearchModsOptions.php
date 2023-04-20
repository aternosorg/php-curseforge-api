<?php

namespace Aternos\CurseForgeApi\Client\Options\ModSearch;

class SearchModsOptions
{
    /**
     * @param int $gameId
     * @param int|null $classId
     * @param int|null $categoryId
     * @param string|null $gameVersion
     * @param string|null $searchFilter Filter by free text search in the mod name and author
     * @param ModSearchSortField|null $sortFiled
     * @param SortOrder|null $sortOrder
     * @param ModLoaderType|null $modLoaderType Filter only mods associated to a given modloader (Forge, Fabric ...). Must be coupled with gameVersion.
     * @param int|null $gameVersionTypeId Filter only mods that contain files tagged with versions of the given gameVersionTypeId
     * @param int|null $authorId
     * @param string|null $slug Filter by slug (coupled with classId will result in a unique result).
     * @param int $offset
     * @param int $pageSize
     */
    public function __construct(
        protected int                 $gameId,
        protected ?int                $classId = null,
        protected ?int                $categoryId = null,
        protected ?string             $gameVersion = null,
        protected ?string             $searchFilter = null,
        protected ?ModSearchSortField $sortFiled = null,
        protected ?SortOrder          $sortOrder = null,
        protected ?ModLoaderType      $modLoaderType = null,
        protected ?int                $gameVersionTypeId = null,
        protected ?int                $authorId = null,
        protected ?string             $slug = null,
        protected int                 $offset = 0,
        protected int                 $pageSize = 50,
    )
    {
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @param int $gameId
     */
    public function setGameId(int $gameId): void
    {
        $this->gameId = $gameId;
    }

    /**
     * @return int|null
     */
    public function getClassId(): ?int
    {
        return $this->classId;
    }

    /**
     * @param int|null $classId
     */
    public function setClassId(?int $classId): void
    {
        $this->classId = $classId;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
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
     * @return string|null
     */
    public function getSearchFilter(): ?string
    {
        return $this->searchFilter;
    }

    /**
     * @param string|null $searchFilter
     */
    public function setSearchFilter(?string $searchFilter): void
    {
        $this->searchFilter = $searchFilter;
    }

    /**
     * @return ModSearchSortField
     */
    public function getSortField(): ModSearchSortField
    {
        return $this->sortFiled;
    }

    /**
     * @param string|null $sortFiled
     */
    public function setSortFiled(?string $sortFiled): void
    {
        $this->sortFiled = $sortFiled;
    }

    /**
     * @return SortOrder
     */
    public function getSortOrder(): SortOrder
    {
        return $this->sortOrder;
    }

    /**
     * @param string|null $sortOrder
     */
    public function setSortOrder(?string $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return ModLoaderType
     */
    public function getModLoaderType(): ModLoaderType
    {
        return $this->modLoaderType;
    }

    /**
     * @param int|null $modLoaderType
     */
    public function setModLoaderType(?int $modLoaderType): void
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
     * @return int|null
     */
    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    /**
     * @param int|null $authorId
     */
    public function setAuthorId(?int $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
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