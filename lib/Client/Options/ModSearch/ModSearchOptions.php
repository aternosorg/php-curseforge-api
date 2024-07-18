<?php

namespace Aternos\CurseForgeApi\Client\Options\ModSearch;

use Aternos\CurseForgeApi\Client\List\PaginatedModList;

class ModSearchOptions
{
    /**
     * @param int $gameId
     * @param int|null $classId
     * @param int|null $categoryId
     * @param string|null $gameVersion
     * @param string|null $searchFilter Filter by free text search in the mod name and author
     * @param ModSearchSortField|null $sortField
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
        protected ?ModSearchSortField $sortField = null,
        protected ?SortOrder          $sortOrder = null,
        protected ?ModLoaderType      $modLoaderType = null,
        protected ?int                $gameVersionTypeId = null,
        protected ?int                $authorId = null,
        protected ?string             $slug = null,
        protected int                 $offset = 0,
        protected int                 $pageSize = PaginatedModList::MAX_PAGE_SIZE,
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
     * @return $this
     */
    public function setGameId(int $gameId): static
    {
        $this->gameId = $gameId;
        return $this;
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
     * @return $this
     */
    public function setClassId(?int $classId): static
    {
        $this->classId = $classId;
        return $this;
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
     * @return $this
     */
    public function setCategoryId(?int $categoryId): static
    {
        $this->categoryId = $categoryId;
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
     * @return string|null
     */
    public function getSearchFilter(): ?string
    {
        return $this->searchFilter;
    }

    /**
     * @param string|null $searchFilter
     * @return $this
     */
    public function setSearchFilter(?string $searchFilter): static
    {
        $this->searchFilter = $searchFilter;
        return $this;
    }

    /**
     * @return ModSearchSortField|null
     */
    public function getSortField(): ?ModSearchSortField
    {
        return $this->sortField;
    }

    /**
     * @param ModSearchSortField|null $sortField
     * @return $this
     */
    public function setSortField(?ModSearchSortField $sortField): static
    {
        $this->sortField = $sortField;
        return $this;
    }

    /**
     * @return SortOrder|null
     */
    public function getSortOrder(): ?SortOrder
    {
        return $this->sortOrder;
    }

    /**
     * @param SortOrder|null $sortOrder
     * @return $this
     */
    public function setSortOrder(?SortOrder $sortOrder): static
    {
        $this->sortOrder = $sortOrder;
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
    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    /**
     * @param int|null $authorId
     * @return $this
     */
    public function setAuthorId(?int $authorId): static
    {
        $this->authorId = $authorId;
        return $this;
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
     * @return $this
     */
    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;
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
