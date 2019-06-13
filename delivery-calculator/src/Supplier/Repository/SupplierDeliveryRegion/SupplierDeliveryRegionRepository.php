<?php

namespace App\Supplier\Repository\SupplierDeliveryRegion;

use App\Core\Type\WholeNumber;
use App\Region\Type\RegionId;
use App\Supplier\Collection\SupplierDeliveryRegionCollection;
use App\Supplier\Entity\SupplierDeliveryRegion;
use App\Supplier\Type\SupplierId;

class SupplierDeliveryRegionRepository implements SupplierDeliveryRegionRepositoryInterface
{
    public function getSupplierDeliveryRegionsForSupplier(SupplierId $supplierId): SupplierDeliveryRegionCollection
    {
        $collection = new SupplierDeliveryRegionCollection();

        $collection->add(new SupplierDeliveryRegion(
            $supplierId,
            new RegionId('e7798c4e-000e-4a1f-84d0-b26f61bfa68a'),
            new WholeNumber(1)
        ));

        $collection->add(new SupplierDeliveryRegion(
            $supplierId,
            new RegionId('c8a08be3-2d57-403e-887a-c523cb65b424'),
            new WholeNumber(2)
        ));

        return $collection;
    }
}