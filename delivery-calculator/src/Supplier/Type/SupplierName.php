<?php

namespace App\Supplier\Type;

use App\Core\Type\ConstrainedString;

class SupplierName extends ConstrainedString
{
    public function __construct(string $value)
    {
        parent::__construct($value, 1, 255);
    }
}