<?php

namespace App\Region\Type;

use App\Core\Type\ConstrainedString;

class RegionName extends ConstrainedString
{
    public function __construct(string $value)
    {
        parent::__construct($value, 1, 45);
    }
}
