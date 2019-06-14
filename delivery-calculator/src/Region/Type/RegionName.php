<?php

namespace App\Region\Type;

use App\Core\Type\ConstrainedString;

/**
 * Class RegionName
 * @package App\Region\Type
 *
 * Represents a Region name
 */
class RegionName extends ConstrainedString
{
    public function __construct(string $value)
    {
        parent::__construct($value, 1, 45);
    }
}
