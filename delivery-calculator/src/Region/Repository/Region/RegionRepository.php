<?php

namespace App\Region\Repository\Region;

use App\Region\Entity\Region;
use App\Region\Type\RegionId;
use App\Region\Type\RegionName;
use App\Region\Collection\RegionCollection;

class RegionRepository implements RegionRepositoryInterface
{
    public function getRegions(): RegionCollection
    {
        $collection = new RegionCollection();

        $collection->add(new Region(
            new RegionId('d3e4fee6-017a-42e5-95e0-75e98940102b'),
            new RegionName('Australia')
        ));

        $collection->add(new Region(
            new RegionId('c8a08be3-2d57-403e-887a-c523cb65b424'),
            new RegionName('Europe')
        ));

        $collection->add(new Region(
            new RegionId('e7798c4e-000e-4a1f-84d0-b26f61bfa68a'),
            new RegionName('UK')
        ));

        $collection->add(new Region(
            new RegionId('feb881ef-e8c9-4dcf-9d9b-42e9a85a7e13'),
            new RegionName('USA')
        ));

        return $collection;
    }
}