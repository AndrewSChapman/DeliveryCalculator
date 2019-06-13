<?php

namespace App\Region\Repository\Region;

use App\Region\Collection\RegionCollection;

interface RegionRepositoryInterface
{
    public function getRegions(): RegionCollection;
}