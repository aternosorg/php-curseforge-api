<?php

namespace Aternos\CurseForgeApi\Client\Options;

use Aternos\CurseForgeApi\Client\List\PaginatedModList;
use Aternos\CurseForgeApi\Model\ModLoaderType;
use Aternos\CurseForgeApi\Model\ModsSearchSortField;
use Aternos\CurseForgeApi\Model\PremiumType;
use Aternos\CurseForgeApi\Model\SortOrder;

class ModSearchOptions
{
    /**
     * @param int $gameId
     * @param int|null $classId
     * @param int[]|null $categoryIds
     * @param string[]|null $gameVersions
     * @param string|null $searchFilter Filter by free text search in the mod name and author
     * @param ModsSearchSortField|null $sortField
     * @param SortOrder|null $sortOrder
     * @param ModLoaderType[]|null $modLoaderTypes Filter only mods associated to a given mod loader (Forge, Fabric ...). Must be coupled with gameVersion.
     * @param int|null $gameVersionTypeId Filter only mods that contain files tagged with versions of the given gameVersionTypeId
     * @param int|null $authorId Filter only mods that the given authorId is a member of
     * @param int|null $primaryAuthorId Filter only mods that have the given author as primary author
     * @param PremiumType|null $premiumType Filter only mods that are Premium or not
     * @param string|null $slug Filter by slug (coupled with classId will result in a unique result).
     * @param int $offset
     * @param int $pageSize
     */
    public function __construct(
        protected int                 $gameId,
        protected int                 $offset = 0,
        protected int                 $pageSize = PaginatedModList::MAX_PAGE_SIZE,
        protected ?int                $classId = null,
        protected ?array              $categoryIds = null,
        protected ?array              $gameVersions = null,
        protected ?string             $searchFilter = null,
        protected ?ModsSearchSortField $sortField = null,
        protected ?SortOrder          $sortOrder = null,
        protected ?array              $modLoaderTypes = null,
        protected ?int                $gameVersionTypeId = null,
        protected ?int                $authorId = null,
        protected ?int                $primaryAuthorId = null,
        protected ?PremiumType        $premiumType = null,
        protected ?string             $slug = null,
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
     * @return int[]|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    /**
     * Get the categories encoded for the API request
     * @return string|null
     */
    public function getEncodedCategoryIds(): ?string
    {
        if ($this->categoryIds === null) {
            return null;
        }

        return json_encode($this->categoryIds);
    }

    /**
     * Set the category IDs to filter the search results
     * @param int[]|null $categoryIds
     * @return $this
     */
    public function setCategoryIds(?array $categoryIds): static
    {
        $this->categoryIds = $categoryIds;
        return $this;
    }

    /**
     * Add a category ID to filter the search results
     * @param int $categoryId
     * @return $this
     */
    public function addCategoryId(int $categoryId): static
    {
        $this->categoryIds ??= [];
        $this->categoryIds[] = $categoryId;
        return $this;
    }

    /**
     * Remove a category ID from the filter
     * @param int $categoryId
     * @return $this
     */
    public function removeCategoryId(int $categoryId): static
    {
        $this->categoryIds = array_values(array_filter($this->categoryIds, fn($value) => $value !== $categoryId));
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getGameVersions(): ?array
    {
        return $this->gameVersions;
    }

    /**
     * Get the game versions encoded for the API request
     * @return string|null
     */
    public function getEncodedGameVersions(): ?string
    {
        if ($this->gameVersions === null) {
            return null;
        }

        return json_encode($this->gameVersions);
    }

    /**
     * @param string[]|null $gameVersions
     * @return $this
     */
    public function setGameVersions(?array $gameVersions): static
    {
        $this->gameVersions = $gameVersions;
        return $this;
    }

    /**
     * Add a game version to the filter
     * @param string $gameVersion
     * @return $this
     */
    public function addGameVersion(string $gameVersion): static
    {
        $this->gameVersions ??= [];
        $this->gameVersions[] = $gameVersion;
        return $this;
    }

    /**
     * Remove a game version from the filter
     * @param string $gameVersion
     * @return $this
     */
    public function removeGameVersion(string $gameVersion): static
    {
        $this->gameVersions = array_values(array_filter($this->gameVersions, fn($value) => $value !== $gameVersion));
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
     * @return ModsSearchSortField|null
     */
    public function getSortField(): ?ModsSearchSortField
    {
        return $this->sortField;
    }

    /**
     * @param ModsSearchSortField|null $sortField
     * @return $this
     */
    public function setSortField(?ModsSearchSortField $sortField): static
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
     * @return ModLoaderType[]|null
     */
    public function getModLoaderTypes(): ?array
    {
        return $this->modLoaderTypes;
    }

    /**
     * Get the mod loader types encoded for the API request
     * @return string|null
     */
    public function getEncodedModLoaderTypes(): ?string
    {
        if ($this->modLoaderTypes === null) {
            return null;
        }

        $result = [];

        foreach ($this->modLoaderTypes as $modLoaderType) {
            $result[] = $modLoaderType->value;
        }

        return json_encode($result);
    }

    /**
     * @param ModLoaderType[]|null $modLoaderTypes
     * @return $this
     */
    public function setModLoaderTypes(?array $modLoaderTypes): static
    {
        $this->modLoaderTypes = $modLoaderTypes;
        return $this;
    }

    /**
     * Add a mod loader type to the filter
     * @param ModLoaderType $modLoaderType
     * @return $this
     */
    public function addModLoaderType(ModLoaderType $modLoaderType): static
    {
        $this->modLoaderTypes ??= [];
        $this->modLoaderTypes[] = $modLoaderType;
        return $this;
    }

    /**
     * Remove a mod loader type from the filter
     * @param ModLoaderType $modLoaderType
     * @return $this
     */
    public function removeModLoaderType(ModLoaderType $modLoaderType): static
    {
        $this->modLoaderTypes = array_values(array_filter($this->modLoaderTypes, fn($value) => $value !== $modLoaderType));
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
     * @return int|null
     */
    public function getPrimaryAuthorId(): ?int
    {
        return $this->primaryAuthorId;
    }

    /**
     * @param int|null $primaryAuthorId
     * @return $this
     */
    public function setPrimaryAuthorId(?int $primaryAuthorId): static
    {
        $this->primaryAuthorId = $primaryAuthorId;
        return $this;
    }

    /**
     * @return PremiumType|null
     */
    public function getPremiumType(): ?PremiumType
    {
        return $this->premiumType;
    }

    /**
     * @param PremiumType|null $premiumType
     * @return $this
     */
    public function setPremiumType(?PremiumType $premiumType): static
    {
        $this->premiumType = $premiumType;
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
}
