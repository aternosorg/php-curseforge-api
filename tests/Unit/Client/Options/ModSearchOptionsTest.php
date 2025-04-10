<?php

namespace Aternos\CurseForgeApi\Tests\Unit\Client\Options;

use Aternos\CurseForgeApi\Client\Options\ModSearchOptions;
use Aternos\CurseForgeApi\Model\ModLoaderType;
use Aternos\CurseForgeApi\Model\ModSearchSortField;
use Aternos\CurseForgeApi\Model\PremiumType;
use Aternos\CurseForgeApi\Model\SortOrder;
use PHPUnit\Framework\TestCase;

class ModSearchOptionsTest extends TestCase
{
    public function testConstruct(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertSame(1, $modSearchOptions->getGameId());
        $this->assertSame(0, $modSearchOptions->getOffset());
        $this->assertSame(50, $modSearchOptions->getPageSize());
        $this->assertNull($modSearchOptions->getClassId());
        $this->assertNull($modSearchOptions->getCategoryIds());
        $this->assertNull($modSearchOptions->getGameVersions());
        $this->assertNull($modSearchOptions->getSearchFilter());
        $this->assertNull($modSearchOptions->getSortField());
        $this->assertNull($modSearchOptions->getSortOrder());
        $this->assertNull($modSearchOptions->getModLoaderTypes());
        $this->assertNull($modSearchOptions->getGameVersionTypeId());
        $this->assertNull($modSearchOptions->getAuthorId());
        $this->assertNull($modSearchOptions->getPrimaryAuthorId());
        $this->assertNull($modSearchOptions->getPremiumType());
        $this->assertNull($modSearchOptions->getSlug());
    }

    public function testSetGameId(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertSame(1, $modSearchOptions->getGameId());
        $modSearchOptions->setGameId(2);
        $this->assertSame(2, $modSearchOptions->getGameId());
    }

    public function testSetOffset(): void
    {
        $modSearchOptions = new ModSearchOptions(1, 10);
        $this->assertSame(10, $modSearchOptions->getOffset());
        $modSearchOptions->setOffset(20);
        $this->assertSame(20, $modSearchOptions->getOffset());
    }

    public function testSetPageSize(): void
    {
        $modSearchOptions = new ModSearchOptions(1, 0, 20);
        $this->assertSame(20, $modSearchOptions->getPageSize());
        $modSearchOptions->setPageSize(30);
        $this->assertSame(30, $modSearchOptions->getPageSize());
    }

    public function testSetClassId(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getClassId());
        $modSearchOptions->setClassId(2);
        $this->assertSame(2, $modSearchOptions->getClassId());
        $modSearchOptions->setClassId(null);
        $this->assertNull($modSearchOptions->getClassId());
    }

    public function testSetCategoryIds(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getCategoryIds());
        $modSearchOptions->setCategoryIds([2, 3]);
        $this->assertSame([2, 3], $modSearchOptions->getCategoryIds());
        $modSearchOptions->setCategoryIds(null);
        $this->assertNull($modSearchOptions->getCategoryIds());
    }

    public function testAddCategoryId(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getCategoryIds());
        $modSearchOptions->addCategoryId(2);
        $this->assertSame([2], $modSearchOptions->getCategoryIds());
        $modSearchOptions->addCategoryId(3);
        $this->assertSame([2, 3], $modSearchOptions->getCategoryIds());
    }

    public function testRemoveCategoryId(): void
    {
        $modSearchOptions = new ModSearchOptions(1, categoryIds: [1, 2]);
        $this->assertSame([1, 2], $modSearchOptions->getCategoryIds());
        $modSearchOptions->removeCategoryId(1);
        $this->assertSame([2], $modSearchOptions->getCategoryIds());
        $modSearchOptions->removeCategoryId(2);
        $this->assertSame([], $modSearchOptions->getCategoryIds());
    }

    public function testGetEncodedCategoryIds(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getEncodedCategoryIds());
        $modSearchOptions->setCategoryIds([2, 3]);
        $this->assertSame("[2,3]", $modSearchOptions->getEncodedCategoryIds());
    }

    public function testSetGameVersions(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getGameVersions());
        $modSearchOptions->setGameVersions(["1.16.4", "1.16.5"]);
        $this->assertSame(["1.16.4", "1.16.5"], $modSearchOptions->getGameVersions());
        $modSearchOptions->setGameVersions(null);
        $this->assertNull($modSearchOptions->getGameVersions());
    }

    public function testAddGameVersion(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getGameVersions());
        $modSearchOptions->addGameVersion("1.16.4");
        $this->assertSame(["1.16.4"], $modSearchOptions->getGameVersions());
        $modSearchOptions->addGameVersion("1.16.5");
        $this->assertSame(["1.16.4", "1.16.5"], $modSearchOptions->getGameVersions());
    }

    public function testRemoveGameVersion(): void
    {
        $modSearchOptions = new ModSearchOptions(1, gameVersions: ["1.16.4", "1.16.5"]);
        $this->assertSame(["1.16.4", "1.16.5"], $modSearchOptions->getGameVersions());
        $modSearchOptions->removeGameVersion("1.16.4");
        $this->assertSame(["1.16.5"], $modSearchOptions->getGameVersions());
        $modSearchOptions->removeGameVersion("1.16.5");
        $this->assertSame([], $modSearchOptions->getGameVersions());
    }

    public function testGetEncodedGameVersions(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getEncodedGameVersions());
        $modSearchOptions->setGameVersions(["1.16.4", "1.16.5"]);
        $this->assertSame("[\"1.16.4\",\"1.16.5\"]", $modSearchOptions->getEncodedGameVersions());
    }

    public function testSetSearchFilter(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getSearchFilter());
        $modSearchOptions->setSearchFilter("test");
        $this->assertSame("test", $modSearchOptions->getSearchFilter());
        $modSearchOptions->setSearchFilter(null);
        $this->assertNull($modSearchOptions->getSearchFilter());
    }

    public function testSetSortField(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getSortField());
        $modSearchOptions->setSortField(ModSearchSortField::NAME);
        $this->assertSame(ModSearchSortField::NAME, $modSearchOptions->getSortField());
        $modSearchOptions->setSortField(null);
        $this->assertNull($modSearchOptions->getSortField());
    }

    public function testSetSortOrder(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getSortOrder());
        $modSearchOptions->setSortOrder(SortOrder::ASCENDING);
        $this->assertSame(SortOrder::ASCENDING, $modSearchOptions->getSortOrder());
        $modSearchOptions->setSortOrder(null);
        $this->assertNull($modSearchOptions->getSortOrder());
    }

    public function testSetModLoaderTypes(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getModLoaderTypes());
        $modSearchOptions->setModLoaderTypes([ModLoaderType::FORGE, ModLoaderType::FABRIC]);
        $this->assertSame([ModLoaderType::FORGE, ModLoaderType::FABRIC], $modSearchOptions->getModLoaderTypes());
        $modSearchOptions->setModLoaderTypes(null);
        $this->assertNull($modSearchOptions->getModLoaderTypes());
    }

    public function testAddModLoaderType(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getModLoaderTypes());
        $modSearchOptions->addModLoaderType(ModLoaderType::FORGE);
        $this->assertSame([ModLoaderType::FORGE], $modSearchOptions->getModLoaderTypes());
        $modSearchOptions->addModLoaderType(ModLoaderType::FABRIC);
        $this->assertSame([ModLoaderType::FORGE, ModLoaderType::FABRIC], $modSearchOptions->getModLoaderTypes());
    }

    public function testRemoveModLoaderType(): void
    {
        $modSearchOptions = new ModSearchOptions(1, modLoaderTypes: [ModLoaderType::FORGE, ModLoaderType::FABRIC]);
        $this->assertSame([ModLoaderType::FORGE, ModLoaderType::FABRIC], $modSearchOptions->getModLoaderTypes());
        $modSearchOptions->removeModLoaderType(ModLoaderType::FORGE);
        $this->assertSame([ModLoaderType::FABRIC], $modSearchOptions->getModLoaderTypes());
        $modSearchOptions->removeModLoaderType(ModLoaderType::FABRIC);
        $this->assertSame([], $modSearchOptions->getModLoaderTypes());
    }

    public function testGetEncodedModLoaderTypes(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getEncodedModLoaderTypes());
        $modSearchOptions->setModLoaderTypes([ModLoaderType::FORGE, ModLoaderType::FABRIC]);
        $this->assertSame("[1,4]", $modSearchOptions->getEncodedModLoaderTypes());
    }

    public function testSetGameVersionTypeId(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getGameVersionTypeId());
        $modSearchOptions->setGameVersionTypeId(2);
        $this->assertSame(2, $modSearchOptions->getGameVersionTypeId());
        $modSearchOptions->setGameVersionTypeId(null);
        $this->assertNull($modSearchOptions->getGameVersionTypeId());
    }

    public function testSetAuthorId(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getAuthorId());
        $modSearchOptions->setAuthorId(2);
        $this->assertSame(2, $modSearchOptions->getAuthorId());
        $modSearchOptions->setAuthorId(null);
        $this->assertNull($modSearchOptions->getAuthorId());
    }

    public function testSetPrimaryAuthorId(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getPrimaryAuthorId());
        $modSearchOptions->setPrimaryAuthorId(2);
        $this->assertSame(2, $modSearchOptions->getPrimaryAuthorId());
        $modSearchOptions->setPrimaryAuthorId(null);
        $this->assertNull($modSearchOptions->getPrimaryAuthorId());
    }

    public function testSetPremiumType(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getPremiumType());
        $modSearchOptions->setPremiumType(PremiumType::FREE);
        $this->assertSame(PremiumType::FREE, $modSearchOptions->getPremiumType());
        $modSearchOptions->setPremiumType(null);
        $this->assertNull($modSearchOptions->getPremiumType());
    }

    public function testSetSlug(): void
    {
        $modSearchOptions = new ModSearchOptions(1);
        $this->assertNull($modSearchOptions->getSlug());
        $modSearchOptions->setSlug("test-slug");
        $this->assertSame("test-slug", $modSearchOptions->getSlug());
    }
}
