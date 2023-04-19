<?php

namespace Aternos\CurseForgeApi\Client;

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
}