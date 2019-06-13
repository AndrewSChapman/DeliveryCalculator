<?php

namespace App\Tests\Unit\Supplier;

use App\Core\Type\DayNumber;
use App\Core\Type\Time;
use App\Supplier\Entity\SupplierDeliveryDay;
use App\Supplier\Type\SupplierId;
use PHPUnit\Framework\TestCase;

class SupplierDeliveryDayTest extends TestCase
{
    private const SUPPLIER_ID = '23d7ee40-8ba0-471d-a807-fc5c9a98494f';
    private const DELIVERY_DAY = 1;
    private const START_TIME = '00:00:00';
    private const END_TIME = '16:00:00';
    private const START_TIME2 = '09:00:00';

    public function testCanCreateNewSupplierDeliveryDay(): void
    {
        $supplierDeliveryDay = new SupplierDeliveryDay(
            new SupplierId(self::SUPPLIER_ID),
            new DayNumber(self::DELIVERY_DAY),
            Time::fromString(self::START_TIME),
            Time::fromString(self::END_TIME)
        );

        $this->assertEquals(self::SUPPLIER_ID, $supplierDeliveryDay->getSupplierId()->getUuid()->toString());
        $this->assertEquals(self::DELIVERY_DAY, $supplierDeliveryDay->getDayNumber()->getValue());
        $this->assertEquals(self::START_TIME, $supplierDeliveryDay->getStartTime()->toString());
        $this->assertEquals(self::END_TIME, $supplierDeliveryDay->getEndTime()->toString());
    }

    public function testSupplierDeliveryDayTimeComparisonWorksCorrectly(): void
    {
        $supplierDeliveryDay = new SupplierDeliveryDay(
            new SupplierId(self::SUPPLIER_ID),
            new DayNumber(self::DELIVERY_DAY),
            Time::fromString(self::START_TIME2),
            Time::fromString(self::END_TIME)
        );

        $beforeTime = Time::fromString('08:59:59');
        $afterTime = Time::fromString('16:00:01');

        $this->assertTrue($supplierDeliveryDay->timeIsBeforeStartTime($beforeTime));
        $this->assertTrue($supplierDeliveryDay->timeIsAfterEndTime($afterTime));
        $this->assertFalse($supplierDeliveryDay->timeIsBeforeStartTime($afterTime));
        $this->assertFalse($supplierDeliveryDay->timeIsAfterEndTime($beforeTime));
    }
}