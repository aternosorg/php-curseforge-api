<?php

namespace Aternos\CurseForgeApi\Client\List;


use ArrayAccess;
use Aternos\CurseForgeApi\ApiException;
use Aternos\CurseForgeApi\Model\Pagination;
use Countable;
use Iterator;

/**
 * Class PaginatedList
 *
 * @package Aternos\CurseForgeApi\Client\List
 * @description A paginated list of results
 * @template T
 */
abstract class PaginatedList implements Iterator, ArrayAccess, Countable
{
    /**
     * The limit for how many results are allowed to be requested.
     * @var int
     */
    public const int LIMIT = 10_000;

    /**
     * The maximum page size that can be requested.
     * @var int
     */
    public const int MAX_PAGE_SIZE = 50;

    protected int $iterator = 0;


    /**
     * Get the maximum page size that can be requested.
     * @param int $offset
     * @param int $target
     * @return int
     */
    public static function getAllowedPageSize(int $offset, int $target = self::MAX_PAGE_SIZE): int
    {
        return min($target, self::MAX_PAGE_SIZE, static::LIMIT - $offset);
    }

    protected function __construct(
        protected Pagination $pagination,
        /**
         * @var T[]
         */
        protected array $results,
    )
    {
    }

    /**
     * Get the pagination part of the response
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    /**
     * @return T[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * Get a new page of results starting at the given offset
     * @param int $offset
     * @param int $pageSize
     * @return $this
     * @throws ApiException
     */
    public abstract function getOffset(int $offset, int $pageSize): static;

    /**
     * returns true if there is a next page with results on it
     * @return bool
     */
    public function hasNextPage(): bool
    {
        return min($this->pagination->getTotalCount(), static::LIMIT) > $this->getNextOffset();
    }

    /**
     * get the next page
     * returns null if there is no next page
     * @return static|null
     * @throws ApiException
     */
    public function getNextPage(): ?static
    {
        if (!$this->hasNextPage()) {
            return null;
        }

        $offset = $this->getNextOffset();
        return $this->getOffset($offset, $this->getNextPageSize($offset));
    }

    /**
     * returns true if there is a previous page with results on it
     * @return bool
     */
    public function hasPreviousPage(): bool
    {
        return $this->pagination->getIndex() > 0;
    }

    /**
     * get the offset of the previous page
     * returns 0 if there is no previous page
     * @return int
     */
    protected function getPreviousOffset(): int
    {
        return max(0, $this->pagination->getIndex() - $this->pagination->getPageSize());
    }

    /**
     * get the previous page
     * returns null if there is no previous page
     * @return static|null
     * @throws ApiException
     */
    public function getPreviousPage(): ?static
    {
        if (!$this->hasPreviousPage()) {
            return null;
        }

        return $this->getOffset($this->getPreviousOffset(), $this->pagination->getPageSize());
    }

    /**
     * Get all results from this page and all following pages.
     * This will request each page from the api one by one.
     *
     * When called on the first page this will return all results.
     *
     * @throws ApiException
     * @return T[]
     */
    public function getResultsFromFollowingPages(): array
    {
        $results = $this->getResults();
        $nextPage = $this->getNextPage();
        while ($nextPage !== null) {
            array_push($results, ...$nextPage->getResults());
            $nextPage = $nextPage->getNextPage();
        }
        return $results;
    }

    /**
     * @inheritDoc
     * @return T
     */
    public function current(): mixed
    {
        return $this->results[$this->iterator];
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->iterator++;
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function key(): int
    {
        return $this->iterator;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return array_key_exists($this->iterator, $this->results);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->iterator = 0;
    }

    /**
     * @inheritDoc
     * @param int $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->results[$offset]);
    }

    /**
     * @inheritDoc
     * @param int $offset
     * @return T
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->results[$offset];
    }

    /**
     * @inheritDoc
     * @param int $offset
     * @param T $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->results[$offset] = $value;
    }

    /**
     * @inheritDoc
     * @param int $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->results[$offset]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->results);
    }

    /**
     * @param int $offset
     * @return int
     */
    protected function getNextPageSize(int $offset): int
    {
        return static::getAllowedPageSize($offset, $this->pagination->getPageSize());
    }

    /**
     * get the offset of the next page
     * @return int
     */
    protected function getNextOffset(): int
    {
        return $this->pagination->getIndex() + $this->pagination->getPageSize();
    }
}
