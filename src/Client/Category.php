<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Client\List\PaginatedModList;
use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Model\Category as CategoryModel;

class Category extends CategoryModel
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        CategoryModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Search mods in this category
     * This sends a request to the CurseForge API every time it is called.
     * @param ModSearchOptions|null $options
     * @return PaginatedModList
     * @throws ApiException
     */
    public function fetchMods(?ModSearchOptions $options = null): PaginatedModList
    {
        if ($options === null) {
            $options = new ModSearchOptions($this->getGameId());
        }

        if ($this->getIsClass()) {
            $options->setClassId($this->getId());
        } else {
            $options->setCategoryIds([$this->getId()]);
        }

        return $this->client->searchMods($options);
    }

    /**
     * Fetch the game of this category
     * This sends a request to the CurseForge API every time it is called.
     * @return Game
     * @throws ApiException
     */
    public function fetchGame(): Game
    {
        return $this->client->getGame($this->getGameId());
    }
}
