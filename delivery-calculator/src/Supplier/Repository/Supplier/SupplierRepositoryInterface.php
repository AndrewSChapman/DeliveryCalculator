<?php

namespace App\Supplier\Repository\Supplier;

use App\Supplier\Entity\Supplier;
use App\Supplier\Type\SupplierId;

/**
 * Interface SupplierRepositoryInterface
 * @package App\Supplier\Repository\Supplier
 *
 * Defines the interface for the supplier repository
 */
interface SupplierRepositoryInterface
{
    public function getSupplierById(SupplierId $supplierId): Supplier;
}