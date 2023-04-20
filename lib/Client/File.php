<?php

namespace Aternos\CurseForgeApi\Client;

use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Model\File as FileModel;

class File
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        protected FileModel $file,
    )
    {
    }

    /**
     * @return FileModel
     */
    public function getData(): FileModel
    {
        return $this->file;
    }

    /**
     * Get the server pack file for this version (if it exists)
     * @return File|null
     * @throws ApiException
     */
    public function getServerPack(): ?File
    {
        if (!$this->file->getServerPackFileId()) {
            return null;
        }

        return $this->client->getModFile($this->file->getModId(), $this->file->getServerPackFileId());
    }

    /**
     * Get the changelog of this file
     * @return string|null
     * @throws ApiException
     */
    public function getChangelog(): ?string
    {
        return $this->client->getModFileChangelog($this->file->getModId(), $this->file->getId());
    }

    /**
     * Get the mod of this file
     * @return Mod
     * @throws ApiException
     */
    public function getMod(): Mod
    {
        return $this->client->getMod($this->file->getModId());
    }
}