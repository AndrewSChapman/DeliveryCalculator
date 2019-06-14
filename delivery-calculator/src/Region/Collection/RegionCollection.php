<?php

namespace App\Region\Collection;

use App\Core\Data\AbstractCollection;
use App\Core\Data\Exception\ItemNotFoundException;
use App\Region\Entity\Region;
use App\Region\Type\RegionId;
use App\Region\Type\RegionName;

/**
 * Class RegionCollection
 * @package App\Region\Collection
 *
 * Stores Region Entities in a collection
 */
class RegionCollection extends AbstractCollection
{
    public function add(Region $region): void
    {
        $this->values[] = $region;
    }

    public function current(): Region
    {
        return $this->offsetGet($this->iteratorPointer);
    }

    public function offsetGet($offset): Region
    {
        return $this->values[$offset];
    }

    public function findByRegionId(RegionId $regionId): Region
    {
        foreach ($this as $region) {
            if ($region->getId()->__toString() === $regionId->__toString()) {
                return $region;
            }
        }

        throw new ItemNotFoundException(
            sprintf('A region with ID %s could not be found', $regionId->__toString()));
    }

    public function findByRegionName(RegionName $regionName): Region
    {
        foreach ($this as $region) {
            if ($region->getName()->getValue() === $regionName->getValue()) {
                return $region;
            }
        }

        throw new ItemNotFoundException(
            sprintf('A region with name "%s" could not be found', $regionName->getValue()));
    }
}
