<?php

namespace App\Region\Repository\Region;

use App\Region\Collection\RegionCollection;

/**
 * Interface RegionRepositoryInterface
 * @package App\Region\Repository\Region
 *
 * Provides a means to get a collection of Region entities.
 */
interface RegionRepositoryInterface
{
    public function getRegions(): RegionCollection;
}