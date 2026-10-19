<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Model\File as FileModel;

class File extends FileModel
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        FileModel $data
    )
    {
        parent::__construct($data->container);
    }

    /**
     * Fetch the server pack file for this version (if it exists)
     * This sends a request to the CurseForge API every time it is called.
     * @return File|null
     * @throws ApiException
     */
    public function fetchServerPack(): ?File
    {
        if (!$this->getServerPackFileId()) {
            return null;
        }

        return $this->client->getModFile($this->getModId(), $this->getServerPackFileId());
    }

    /**
     * Fetch the changelog of this file
     * This sends a request to the CurseForge API every time it is called.
     * @param bool|null $raw Get raw changelog without things like external link redirects
     * @param bool|null $stripped Get the changelog with all HTML tags removed
     * @param bool|null $markup
     * @return string
     * @throws ApiException
     */
    public function fetchChangelog(?bool $raw = null, ?bool $stripped = null, ?bool $markup = null): string
    {
        return $this->client->getModFileChangelog($this->getModId(), $this->getId(), $raw, $stripped, $markup);
    }

    /**
     * Fetch the mod of this file
     * This sends a request to the CurseForge API every time it is called.
     * @return Mod
     * @throws ApiException
     */
    public function fetchMod(): Mod
    {
        return $this->client->getMod($this->getModId());
    }
}