<?php

namespace App\Supplier\Type;

use App\Core\Type\ConstrainedString;

/**
 * Class SupplierName
 * @package App\Supplier\Type
 *
 * Represents a supplier name.
 */
class SupplierName extends ConstrainedString
{
    public function __construct(string $value)
    {
        parent::__construct($value, 1, 255);
    }
}