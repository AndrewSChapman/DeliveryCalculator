<?php

namespace App\Supplier\Repository\SupplierDeliveryDay;

use App\Supplier\Collection\SupplierDeliveryDayCollection;
use App\Supplier\Type\SupplierId;

interface SupplierDeliveryDayRepositoryInterface
{
    public function getDeliveryDaysForSupplier(SupplierId $supplierId): SupplierDeliveryDayCollection;
}