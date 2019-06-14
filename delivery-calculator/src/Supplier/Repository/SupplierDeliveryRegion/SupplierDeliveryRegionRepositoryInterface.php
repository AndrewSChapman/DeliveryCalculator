<?php

namespace App\Supplier\Repository\SupplierDeliveryRegion;

use App\Supplier\Collection\SupplierDeliveryRegionCollection;
use App\Supplier\Type\SupplierId;

/**
 * Interface SupplierDeliveryRegionRepositoryInterface
 * @package App\Supplier\Repository\SupplierDeliveryRegion
 *
 * Provides a means to get a collection of supplier delivery regions.
 */
interface SupplierDeliveryRegionRepositoryInterface
{
    public function getSupplierDeliveryRegionsForSupplier(SupplierId $supplierId): SupplierDeliveryRegionCollection;
}
