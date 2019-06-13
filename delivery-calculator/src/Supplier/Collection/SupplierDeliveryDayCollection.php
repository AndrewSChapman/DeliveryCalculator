<?php

namespace App\Supplier\Collection;

use App\Core\Data\AbstractCollection;
use App\Core\Data\Exception\ItemNotFoundException;
use App\Core\Type\DayNumber;
use App\Supplier\Entity\SupplierDeliveryDay;

class SupplierDeliveryDayCollection extends AbstractCollection
{
    public function add(SupplierDeliveryDay $supplierDeliveryDay): void
    {
        $this->values[] = $supplierDeliveryDay;
    }

    public function current(): SupplierDeliveryDay
    {
        return $this->offsetGet($this->iteratorPointer);
    }

    public function offsetGet($offset): SupplierDeliveryDay
    {
        return $this->values[$offset];
    }

    public function getByDayNumber(DayNumber $dayNumber): SupplierDeliveryDay
    {
        foreach ($this as $supplierDeliveryDay) {
            if ($supplierDeliveryDay->getDayNumber()->getValue() === $dayNumber->getValue()) {
                return $supplierDeliveryDay;
            }
        }

        throw new ItemNotFoundException(
            'A SupplierDeliveryDay item was not found for Day Number: ' . $dayNumber->getValue()
        );
    }
}
