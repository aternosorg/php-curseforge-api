<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedModList;
use Aternos\CurseForgeApi\Client\Options\ModSearch\ModSearchOptions;
use Aternos\CurseForgeApi\Model\Category as CategoryModel;

class Category
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        protected CategoryModel       $category,
    )
    {
    }

    /**
     * @return CategoryModel
     */
    public function getData(): CategoryModel
    {
        return $this->category;
    }

    /**
     * Search mods in this category
     * @param ModSearchOptions|null $options
     * @return PaginatedModList
     * @throws ApiException
     */
    public function getMods(?ModSearchOptions $options = null): PaginatedModList
    {
        if ($options === null) {
            $options = new ModSearchOptions($this->category->getGameId());
        }

        if ($this->category->getIsClass()) {
            $options->setClassId($this->category->getId());
        } else {
            $options->setCategoryIds([$this->category->getId()]);
        }

        return $this->client->searchMods($options);
    }

    /**
     * Get the game of this category
     * @return Game
     * @throws ApiException
     */
    public function getGame(): Game
    {
        return $this->client->getGame($this->category->getGameId());
    }
}
