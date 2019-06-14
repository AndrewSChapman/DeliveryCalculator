<?php

namespace App\Supplier\Repository\Supplier;

use App\Core\Type\WholeNumber;
use App\Supplier\Entity\Supplier;
use App\Supplier\Type\SupplierId;
use App\Supplier\Type\SupplierName;

/**
 * Class SupplierRepository
 * @package App\Supplier\Repository\Supplier
 *
 * Implements the supplier repository
 */
class SupplierRepository implements SupplierRepositoryInterface
{
    public function getSupplierById(SupplierId $supplierId): Supplier
    {
        $supplier = new Supplier(
            new SupplierId('23d7ee40-8ba0-471d-a807-fc5c9a98494f'),
            new SupplierName('Royal Mail'),
            new WholeNumber(3)
        );

        return $supplier;
    }
}