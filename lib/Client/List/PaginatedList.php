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
    protected int $iterator = 0;

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
     * @return T[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * Get a new page of results starting at the given offset
     * @param int $offset
     * @return $this
     * @throws ApiException
     */
    public abstract function getOffset(int $offset): static;

    /**
     * returns true if there is a next page with results on it
     * @return bool
     */
    public function hasNextPage(): bool
    {
        return $this->pagination->getTotalCount() > $this->getNextOffset();
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

        return $this->getOffset($this->getNextOffset());
    }

    /**
     * get the offset of the next page
     * @return int
     */
    protected function getNextOffset(): int
    {
        return $this->pagination->getIndex() + $this->pagination->getPageSize();
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

        return $this->getOffset($this->getPreviousOffset());
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
}