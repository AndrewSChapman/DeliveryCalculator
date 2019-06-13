<?php

namespace App\Core\Type;

use App\Core\Type\Exception\ConstraintException;

class WholeNumber
{
    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new ConstraintException('WholeNumber must be >= 0');
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function toString(): string
    {
        return strval($this->value);
    }
}