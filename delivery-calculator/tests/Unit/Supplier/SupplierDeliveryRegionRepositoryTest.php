<?php

namespace App\Tests\Unit\Supplier;

use App\Supplier\Repository\SupplierDeliveryRegion\SupplierDeliveryRegionRepository;
use App\Supplier\Type\SupplierId;
use PHPUnit\Framework\TestCase;

class SupplierDeliveryRegionRepositoryTest extends TestCase
{
    public function testSupplierDeliveryRegionRepoWillReturnEntities(): void
    {
        $repo = new SupplierDeliveryRegionRepository();
        $collection = $repo->getSupplierDeliveryRegionsForSupplier(
            new SupplierId('23d7ee40-8ba0-471d-a807-fc5c9a98494f'));

        $this->assertCount(2, $collection);
    }
}