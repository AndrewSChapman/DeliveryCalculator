<?php

namespace App\Tests\Unit\Supplier;

use App\Core\Data\Exception\ItemNotFoundException;
use App\Core\Type\DayNumber;
use App\Supplier\Repository\SupplierDeliveryDay\SupplierDeliveryDayRepository;
use App\Supplier\Type\SupplierId;
use PHPUnit\Framework\TestCase;

class SupplierDeliveryDayCollectionTest extends TestCase
{
    public function testSupplierDeliveryDayCollectionWillFindAllReleventDays(): void
    {
        $supplierDeliveryDayRepo = new SupplierDeliveryDayRepository();
        $collection = $supplierDeliveryDayRepo->getDeliveryDaysForSupplier(
            new SupplierId('23d7ee40-8ba0-471d-a807-fc5c9a98494f'));

        $this->assertEquals(1, $collection->getByDayNumber(new DayNumber(1))->getDayNumber()->getValue());
        $this->assertEquals(2, $collection->getByDayNumber(new DayNumber(2))->getDayNumber()->getValue());
        $this->assertEquals(3, $collection->getByDayNumber(new DayNumber(3))->getDayNumber()->getValue());
        $this->assertEquals(4, $collection->getByDayNumber(new DayNumber(4))->getDayNumber()->getValue());
        $this->assertEquals(5, $collection->getByDayNumber(new DayNumber(5))->getDayNumber()->getValue());
    }

    public function testSupplierDeliveryDayCollectionWillThrowExceptionWhenItemNotFound(): void
    {
        $this->expectException(ItemNotFoundException::class);

        $supplierDeliveryDayRepo = new SupplierDeliveryDayRepository();
        $collection = $supplierDeliveryDayRepo->getDeliveryDaysForSupplier(
            new SupplierId('23d7ee40-8ba0-471d-a807-fc5c9a98494f'));

        $collection->getByDayNumber(new DayNumber(DayNumber::DAY_SUNDAY));
    }
}