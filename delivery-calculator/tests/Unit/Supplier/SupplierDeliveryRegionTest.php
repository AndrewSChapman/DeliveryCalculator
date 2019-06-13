<?php

namespace App\Tests\Unit\Supplier;

use App\Core\Type\WholeNumber;
use App\Region\Type\RegionId;
use App\Supplier\Entity\SupplierDeliveryRegion;
use App\Supplier\Type\SupplierId;
use PHPUnit\Framework\TestCase;

class SupplierDeliveryRegionTest extends TestCase
{
    private const SUPPLIER_ID = '23d7ee40-8ba0-471d-a807-fc5c9a98494f';
    private const REGION_ID = '7e87ca4c-126d-4446-be2a-caac921f6394';
    private const NUM_DAYS_TO_DELIVER = 3;

    public function testCanCreateNewSupplierDeliveryRegion(): void
    {
        $supplierDeliveryRegion = new SupplierDeliveryRegion(
            new SupplierId(self::SUPPLIER_ID),
            new RegionId(self::REGION_ID),
            new WholeNumber(self::NUM_DAYS_TO_DELIVER)
        );

        $this->assertEquals(self::SUPPLIER_ID, $supplierDeliveryRegion->getSupplierId()->getUuid()->toString());
        $this->assertEquals(self::REGION_ID, $supplierDeliveryRegion->getRegionId()->getUuid()->toString());
        $this->assertEquals(self::NUM_DAYS_TO_DELIVER,
            $supplierDeliveryRegion->getNumBusinessDaysToDeliver()->getValue());
    }
}