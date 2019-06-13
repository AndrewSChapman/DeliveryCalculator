<?php

namespace App\Tests\Unit\Supplier;

use App\Core\Data\Exception\ItemNotFoundException;
use App\Region\Repository\Region\RegionRepository;
use App\Region\Type\RegionId;
use App\Region\Type\RegionName;
use PHPUnit\Framework\TestCase;

class RegionCollectionTest extends TestCase
{
    public function testRegionCollectionWillSearchById(): void
    {
        $regionRepo = new RegionRepository();
        $collection = $regionRepo->getRegions();

        $this->assertEquals('Australia', $collection->findByRegionId(new RegionId('d3e4fee6-017a-42e5-95e0-75e98940102b'))->getName()->toString());
        $this->assertEquals('USA', $collection->findByRegionId(new RegionId('feb881ef-e8c9-4dcf-9d9b-42e9a85a7e13'))->getName()->toString());
    }

    public function testRegionCollectionWillSearchByName(): void
    {
        $regionRepo = new RegionRepository();
        $collection = $regionRepo->getRegions();

        $this->assertEquals('d3e4fee6-017a-42e5-95e0-75e98940102b',
            $collection->findByRegionName(new RegionName('Australia'))->getId()->__toString());

        $this->assertEquals('feb881ef-e8c9-4dcf-9d9b-42e9a85a7e13',
            $collection->findByRegionName(new RegionName('USA'))->getId()->__toString());
    }

    public function testRegionCollectionWillThrowExceptionWhenItemNotFoundWhenSearchingByName(): void
    {
        $this->expectException(ItemNotFoundException::class);

        $regionRepo = new RegionRepository();
        $collection = $regionRepo->getRegions();

        $collection->findByRegionName(new RegionName('Antarctica'));
    }

    public function testRegionCollectionWillThrowExceptionWhenItemNotFoundWhenSearchingById(): void
    {
        $this->expectException(ItemNotFoundException::class);

        $regionRepo = new RegionRepository();
        $collection = $regionRepo->getRegions();

        $collection->findByRegionId(new RegionId('41ab00c3-21b9-4efc-b50c-33c2389fe986'));
    }
}