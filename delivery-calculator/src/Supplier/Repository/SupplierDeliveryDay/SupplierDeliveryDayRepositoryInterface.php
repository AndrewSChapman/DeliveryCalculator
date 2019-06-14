<?php

namespace App\Supplier\Repository\SupplierDeliveryDay;

use App\Supplier\Collection\SupplierDeliveryDayCollection;
use App\Supplier\Type\SupplierId;

/**
 * Interface SupplierDeliveryDayRepositoryInterface
 * @package App\Supplier\Repository\SupplierDeliveryDay
 *
 * Provides a means to retrieve a supplier delivery day collection for a specified supplier.
 */
interface SupplierDeliveryDayRepositoryInterface
{
    public function getDeliveryDaysForSupplier(SupplierId $supplierId): SupplierDeliveryDayCollection;
}