<?php

namespace App\Tests\Unit\Supplier;

use App\Core\Type\CreatedAt;
use App\Core\Type\Timestamp;
use App\Core\Type\UpdatedAt;
use App\Core\Type\WholeNumber;
use App\Supplier\Entity\Supplier;
use App\Supplier\Type\SupplierId;
use App\Supplier\Type\SupplierName;
use PHPUnit\Framework\TestCase;

class SupplierTest extends TestCase
{
    private const SUPPLIER_NAME = 'Royal Mail';
    private const SUPPLIER_ID = '23d7ee40-8ba0-471d-a807-fc5c9a98494f';
    private const DEFAULT_DELIVERY_DAYS = 3;

    public function testCanCreateNewSupplierWithoutTimestamps(): void
    {
        $supplier = new Supplier(
            new SupplierId(self::SUPPLIER_ID),
            new SupplierName(self::SUPPLIER_NAME),
            new WholeNumber(self::DEFAULT_DELIVERY_DAYS)
        );

        $this->assertEquals(self::SUPPLIER_NAME, $supplier->getName()->toString());
        $this->assertEquals(self::SUPPLIER_ID, $supplier->getId()->getUuid()->toString());
        $this->assertEquals(self::DEFAULT_DELIVERY_DAYS, $supplier->getDefaultDeliveryDays()->getValue());
        $this->assertInstanceOf(Timestamp::class, $supplier->getCreatedAt());
        $this->assertInstanceOf(Timestamp::class, $supplier->getUpdatedAt());
        $this->assertGreaterThan(time() - 10, $supplier->getCreatedAt()->getTimestamp());
        $this->assertGreaterThan(time() - 10, $supplier->getUpdatedAt()->getTimestamp());
    }

    public function testCanCreateNewSupplierWithTimestamps(): void
    {
        $supplier = new Supplier(
            new SupplierId(self::SUPPLIER_ID),
            new SupplierName(self::SUPPLIER_NAME),
            new WholeNumber(self::DEFAULT_DELIVERY_DAYS),
            new CreatedAt(1560081124),
            new UpdatedAt(1560081124)
        );

        $this->assertEquals(self::SUPPLIER_NAME, $supplier->getName()->toString());
        $this->assertEquals(self::SUPPLIER_ID, $supplier->getId()->getUuid()->toString());
        $this->assertEquals(self::DEFAULT_DELIVERY_DAYS, $supplier->getDefaultDeliveryDays()->getValue());
        $this->assertInstanceOf(Timestamp::class, $supplier->getCreatedAt());
        $this->assertInstanceOf(Timestamp::class, $supplier->getUpdatedAt());
        $this->assertEquals(1560081124, $supplier->getCreatedAt()->getTimestamp());
        $this->assertEquals(1560081124, $supplier->getUpdatedAt()->getTimestamp());
    }
}