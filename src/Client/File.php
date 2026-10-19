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
     * @deprecated The file extends the generated model now, so its getters can be used directly.
     * @return FileModel
     */
    public function getData(): FileModel
    {
        return $this;
    }

    /**
     * Get the server pack file for this version (if it exists)
     * @return File|null
     * @throws ApiException
     */
    public function getServerPack(): ?File
    {
        if (!$this->getServerPackFileId()) {
            return null;
        }

        return $this->client->getModFile($this->getModId(), $this->getServerPackFileId());
    }

    /**
     * Get the changelog of this file
     * @param bool|null $raw Get raw changelog without things like external link redirects
     * @param bool|null $stripped Get the changelog with all HTML tags removed
     * @param bool|null $markup
     * @return string
     * @throws ApiException
     */
    public function getChangelog(?bool $raw = null, ?bool $stripped = null, ?bool $markup = null): string
    {
        return $this->client->getModFileChangelog($this->getModId(), $this->getId(), $raw, $stripped, $markup);
    }

    /**
     * Get the mod of this file
     * @return Mod
     * @throws ApiException
     */
    public function getMod(): Mod
    {
        return $this->client->getMod($this->getModId());
    }
}