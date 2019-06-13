<?php

namespace App\Core\Type;

use App\Core\Type\Exception\ConstraintException;

class DayNumber extends WholeNumber
{
    public const DAY_SUNDAY = 0;
    public const DAY_MONDAY = 1;
    public const DAY_TUESDAY = 2;
    public const DAY_WEDNESDAY = 3;
    public const DAY_THURSDAY = 4;
    public const DAY_FRIDAY = 5;
    public const DAY_SATURDAY = 6;

    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        parent::__construct($value);

        if ($value > self::DAY_SATURDAY) {
            throw new ConstraintException('DayNo must be <= 6');
        }
    }
}