<?php

namespace App\Supplier\Service;

use App\Region\Type\RegionId;
use App\Supplier\Type\SupplierId;

/**
 * Interface SupplierDeliveryEstimateServiceInterface
 * @package App\Supplier\Service
 *
 * Provides a means to calculate an estimated delivery date, based on a specified
 * supplier, orderDate and region.
 */
interface SupplierDeliveryEstimateServiceInterface
{
    public function getEstimatedDeliveryDate(
        SupplierId $supplierId,
        \DateTimeImmutable $orderDate,
        RegionId $deliveryRegion
    ): string;
}