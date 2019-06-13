<?php

namespace App\Supplier\Repository\SupplierDeliveryRegion;

use App\Supplier\Collection\SupplierDeliveryRegionCollection;
use App\Supplier\Type\SupplierId;

interface SupplierDeliveryRegionRepositoryInterface
{
    public function getSupplierDeliveryRegionsForSupplier(SupplierId $supplierId): SupplierDeliveryRegionCollection;
}
