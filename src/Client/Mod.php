<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedFilesList;
use Aternos\CurseForgeApi\Client\Options\ModFilesOptions;
use Aternos\CurseForgeApi\Model\Category as CategoryModel;
use Aternos\CurseForgeApi\Model\File as FileModel;
use Aternos\CurseForgeApi\Model\Mod as ModModel;

class Mod extends ModModel
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        ModModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * @param CurseForgeAPIClient $client
     * @param ModModel[] $models
     * @return Mod[]
     */
    public static function fromModels(CurseForgeAPIClient $client, array $models): array
    {
        return array_map(fn($mod) => new Mod($client, $mod), $models);
    }

    /**
     * Fetch the description of this mod as html
     * This sends a request to the CurseForge API every time it is called.
     * @param string|null $lang
     * @return string|null
     * @throws ApiException
     */
    public function fetchDescription(?string $lang = null): ?string
    {
        return $this->client->getModDescription($this->getId(), $lang);
    }

    /**
     * Fetch the files of this mod
     * This sends a request to the CurseForge API every time it is called.
     * @param ModFilesOptions|null $options
     * @return PaginatedFilesList
     * @throws ApiException
     */
    public function fetchFiles(?ModFilesOptions $options = null): PaginatedFilesList
    {
        return $this->client->getModFiles($options ?? new ModFilesOptions($this->getId()));
    }

    /**
     * Fetch the game this mod belongs to
     * This sends a request to the CurseForge API every time it is called.
     * @return Game
     * @throws ApiException
     */
    public function fetchGame(): Game
    {
        return $this->client->getGame($this->getGameId());
    }

    /**
     * Get the categories of this mod
     * @return Category[]|null
     */
    public function getCategories(): ?array
    {
        $categories = parent::getCategories();
        if ($categories === null) {
            return null;
        }
        return array_map(fn(CategoryModel $category) => new Category($this->client, $category), $categories);
    }

    /**
     * Get the primary category of this mod
     * @return Category|null
     */
    public function getPrimaryCategory(): ?Category
    {
        foreach ($this->getCategories() ?? [] as $category) {
            if ($category->getId() === $this->getPrimaryCategoryId()) {
                return $category;
            }
        }
        return null;
    }

    /**
     * Get the latest files of this mod
     * @return File[]|null
     */
    public function getLatestFiles(): ?array
    {
        $files = parent::getLatestFiles();
        if ($files === null) {
            return null;
        }
        return array_map(fn(FileModel $file) => new File($this->client, $file), $files);
    }

    /**
     * Fetch the category class of this mod
     * This sends a request to the CurseForge API every time it is called.
     * @return Category
     * @throws ApiException
     */
    public function fetchCategoryClass(): Category
    {
        return $this->client->getCategory($this->getGameId(), $this->getClassId());
    }

    /**
     * Fetch the main file of this mod
     * This sends a request to the CurseForge API every time it is called.
     * @return File
     * @throws ApiException
     */
    public function fetchMainFile(): File
    {
        return $this->fetchFile($this->getMainFileId());
    }

    /**
     * Fetch a file of this mod
     * This sends a request to the CurseForge API every time it is called.
     * @param int $fileId
     * @return File
     * @throws ApiException
     */
    public function fetchFile(int $fileId): File
    {
        return $this->client->getModFile($this->getId(), $fileId);
    }
}
