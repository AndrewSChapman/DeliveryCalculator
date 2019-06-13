<?php

namespace App\Tests\Unit\Supplier;

use App\Region\Entity\Region;
use App\Region\Type\RegionId;
use App\Region\Type\RegionName;
use PHPUnit\Framework\TestCase;

class RegionTest extends TestCase
{
    private const REGION_NAME = 'EU';
    private const REGION_ID = '23d7ee40-8ba0-471d-a807-fc5c9a98494f';

    public function testCanCreateNewRegion(): void
    {
        $region = new Region(
            new RegionId(self::REGION_ID),
            new RegionName(self::REGION_NAME)
        );

        $this->assertEquals(self::REGION_NAME, $region->getName()->toString());
        $this->assertEquals(self::REGION_ID, $region->getId()->getUuid()->toString());
    }
}