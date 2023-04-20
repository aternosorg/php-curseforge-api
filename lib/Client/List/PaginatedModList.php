<?php

namespace Aternos\CurseForgeApi\Client\List;

use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use Aternos\CurseForgeApi\Client\Mod;
use Aternos\CurseForgeApi\Client\Options\ModSearch\SearchModsOptions;
use Aternos\CurseForgeApi\Model\Mod as ModModel;
use Aternos\CurseForgeApi\Model\SearchModsResponse;

class PaginatedModList extends PaginatedList
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        protected SearchModsResponse $response,
        protected SearchModsOptions $options,
    )
    {
        parent::__construct($this->response->getPagination(), array_map(function (ModModel $mod): Mod {
            return new Mod($this->client, $mod);
        }, $this->response->getData()));
    }

    public function getOffset(int $offset): static
    {
        $options = clone $this->options;
        $options->setOffset($offset);
        return $this->client->searchMods($options);
    }
}