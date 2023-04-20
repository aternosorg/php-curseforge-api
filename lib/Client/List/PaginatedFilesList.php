<?php

namespace Aternos\CurseForgeApi\Client\List;

use Aternos\CurseForgeApi\Client\CurseForgeAPIClient;
use Aternos\CurseForgeApi\Client\File;
use Aternos\CurseForgeApi\Client\Options\ModFiles\ModFilesOptions;
use Aternos\CurseForgeApi\Model\GetModFilesResponse;
use Aternos\CurseForgeApi\Model\File as FileModel;

/**
 * Class PaginatedFilesList
 *
 * @package Aternos\CurseForgeApi\Client\List
 * @description A paginated list of files
 * @extends PaginatedList<File>
 */
class PaginatedFilesList extends PaginatedList
{
    public function __construct(
        protected CurseForgeAPIClient $client,
        GetModFilesResponse $filesResponse,
        protected ModFilesOptions $options,
    )
    {
        parent::__construct($filesResponse->getPagination(), array_map(function (FileModel $file) {
            return new File($this->client, $file);
        }, $filesResponse->getData()));
    }

    public function getOffset(int $offset): static
    {
        $options = clone $this->options;
        $options->setOffset($offset);
        return $this->client->getModFiles($options);
    }
}