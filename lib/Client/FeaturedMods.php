<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\Model\FeaturedModsResponse;

class FeaturedMods
{
    /**
     * @var Mod[]
     */
    protected array $featured = [];

    /**
     * @var Mod[]
     */
    protected array $popular = [];

    /**
     * @var Mod[]
     */
    protected array $recentlyUpdated = [];

    public function __construct(
        protected CurseForgeAPIClient $client,
        FeaturedModsResponse $featuredMods,
    )
    {
        $this->featured = Mod::fromModels($this->client, $featuredMods->getFeatured());
        $this->popular = Mod::fromModels($this->client, $featuredMods->getPopular());
        $this->recentlyUpdated = Mod::fromModels($this->client, $featuredMods->getRecentlyUpdated());
    }
}