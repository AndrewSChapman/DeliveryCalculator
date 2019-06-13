<?php

namespace App\Supplier\Repository\Supplier;

use App\Supplier\Entity\Supplier;
use App\Supplier\Type\SupplierId;

interface SupplierRepositoryInterface
{
    public function getSupplierById(SupplierId $supplierId): Supplier;
}