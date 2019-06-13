<?php
namespace App\Supplier\Entity;

use App\Core\Type\DayNumber;
use App\Core\Type\Time;
use App\Supplier\Type\SupplierId;

class SupplierDeliveryDay
{
    /** @var SupplierId */
    private $supplierId;

    /** @var DayNumber */
    private $dayNumber;

    /** @var Time */
    private $startTime;

    /** @var Time */
    private $endTime;

    public function __construct(
        SupplierId $id,
        DayNumber $dayNumber,
        Time $startTime,
        Time $endTime
    ) {
        $this->supplierId = $id;
        $this->dayNumber = $dayNumber;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getSupplierId(): SupplierId
    {
        return $this->supplierId;
    }

    public function getDayNumber(): DayNumber
    {
        return $this->dayNumber;
    }

    public function getStartTime(): Time
    {
        return $this->startTime;
    }

    public function getEndTime(): Time
    {
        return $this->endTime;
    }

    public function timeIsBeforeStartTime(Time $time): bool
    {
        return $this->startTime->isGreaterThan($time);
    }

    public function timeIsAfterEndTime(Time $time): bool
    {
        return $this->endTime->isLessThan($time);
    }
}