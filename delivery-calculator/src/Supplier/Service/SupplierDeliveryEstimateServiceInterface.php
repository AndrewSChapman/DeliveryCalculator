<?php

namespace App\Supplier\Service;

use App\Region\Type\RegionId;
use App\Supplier\Type\SupplierId;

interface SupplierDeliveryEstimateServiceInterface
{
    public function getEstimatedDeliveryDate(
        SupplierId $supplierId,
        \DateTimeImmutable $orderDate,
        RegionId $deliveryRegion
    ): string;
}