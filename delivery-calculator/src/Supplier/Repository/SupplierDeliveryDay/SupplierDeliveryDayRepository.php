<?php

namespace App\Supplier\Repository\SupplierDeliveryDay;

use App\Core\Type\DayNumber;
use App\Core\Type\Time;
use App\Supplier\Collection\SupplierDeliveryDayCollection;
use App\Supplier\Entity\SupplierDeliveryDay;
use App\Supplier\Type\SupplierId;

class SupplierDeliveryDayRepository implements SupplierDeliveryDayRepositoryInterface
{
    public function getDeliveryDaysForSupplier(SupplierId $supplierId): SupplierDeliveryDayCollection
    {
        $collection = new SupplierDeliveryDayCollection();

        for ($dayNo = DayNumber::DAY_MONDAY; $dayNo <= DayNumber::DAY_SATURDAY; $dayNo++) {
            $collection->add(new SupplierDeliveryDay(
                $supplierId,
                new DayNumber($dayNo),
                Time::fromString('00:00:00'),
                Time::fromString('16:00:00')
            ));
        }

        return $collection;
    }
}