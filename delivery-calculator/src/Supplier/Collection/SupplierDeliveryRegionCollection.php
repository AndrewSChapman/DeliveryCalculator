<?php

namespace App\Supplier\Collection;

use App\Core\Data\AbstractCollection;
use App\Core\Data\Exception\ItemNotFoundException;
use App\Region\Type\RegionId;
use App\Supplier\Entity\SupplierDeliveryRegion;

class SupplierDeliveryRegionCollection extends AbstractCollection
{
    public function add(SupplierDeliveryRegion $supplierDeliveryRegion): void
    {
        $this->values[] = $supplierDeliveryRegion;
    }

    public function current(): SupplierDeliveryRegion
    {
        return $this->offsetGet($this->iteratorPointer);
    }

    public function offsetGet($offset): SupplierDeliveryRegion
    {
        return $this->values[$offset];
    }

    public function getByRegion(RegionId $regionId): SupplierDeliveryRegion
    {
        foreach ($this as $supplierDeliveryRegion) {
            if ($supplierDeliveryRegion->getRegionId()->__toString() === $regionId->__toString()) {
                return $supplierDeliveryRegion;
            }
        }

        throw new ItemNotFoundException(
            'A SupplierDeliveryRegion item was not found for regionId: ' . $regionId
        );
    }
}
