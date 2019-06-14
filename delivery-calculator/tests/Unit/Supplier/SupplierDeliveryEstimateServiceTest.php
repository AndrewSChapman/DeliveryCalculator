<?php

namespace App\Tests\Unit\Supplier;

use App\Region\Type\RegionId;
use App\Supplier\Repository\Supplier\SupplierRepository;
use App\Supplier\Repository\SupplierDeliveryDay\SupplierDeliveryDayRepository;
use App\Supplier\Repository\SupplierDeliveryRegion\SupplierDeliveryRegionRepository;
use App\Supplier\Service\SupplierDeliveryEstimateService;
use App\Supplier\Type\SupplierId;
use PHPUnit\Framework\TestCase;

class SupplierDeliveryEstimateServiceTest extends TestCase
{
    /**
     * @dataProvider deliveryDateDataTestProvider
     */
    public function testSupplierDeliveryEstimateServiceCorrectlyDeterminesDeliveryDates(
        $supplierId,
        $regionId,
        $orderDate,
        $expectedDeliveryDate
    ) {
        $service = new SupplierDeliveryEstimateService(
            new SupplierRepository(),
            new SupplierDeliveryDayRepository(),
            new SupplierDeliveryRegionRepository()
        );

        $orderDate = new \DateTimeImmutable($orderDate);

        $deliveryDate = $service->getEstimatedDeliveryDate(
            new SupplierId($supplierId),
            $orderDate,
            new RegionId($regionId)
        );

        $this->assertEquals($expectedDeliveryDate, $deliveryDate);
    }

    public function deliveryDateDataTestProvider(): array
    {
        return [
            // TEST UK - 1 Business Day delivery.  UK's RegionId is e7798c4e-000e-4a1f-84d0-b26f61bfa68a
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-13 03:42:00', '2019-06-14'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-13 09:00:00', '2019-06-14'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-13 15:59:59', '2019-06-14'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-13 16:00:00', '2019-06-17'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-14 09:00:00', '2019-06-17'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-14 16:00:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-17 09:00:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'e7798c4e-000e-4a1f-84d0-b26f61bfa68a', '2019-06-17 16:00:00', '2019-06-19'],

            // TEST Europe - 2 Business Days delivery.   Europe's RegionId is c8a08be3-2d57-403e-887a-c523cb65b424
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-12 09:00:00', '2019-06-14'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-13 03:42:00', '2019-06-17'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-13 09:00:00', '2019-06-17'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-13 15:59:59', '2019-06-17'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-13 16:00:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-14 09:00:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-14 16:00:00', '2019-06-19'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-17 09:00:00', '2019-06-19'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'c8a08be3-2d57-403e-887a-c523cb65b424', '2019-06-17 16:00:00', '2019-06-20'],

            // TEST Australia (i.e. Should use supplier default, i.e. Rest of the world).  Australia's regionId is d3e4fee6-017a-42e5-95e0-75e98940102b
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-13 03:42:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-13 03:42:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-13 09:00:00', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-13 15:59:59', '2019-06-18'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-13 16:00:00', '2019-06-19'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-14 09:00:00', '2019-06-19'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-14 16:00:00', '2019-06-20'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-17 09:00:00', '2019-06-20'],
            ['23d7ee40-8ba0-471d-a807-fc5c9a98494f', 'd3e4fee6-017a-42e5-95e0-75e98940102b', '2019-06-17 16:00:00', '2019-06-21'],
        ];
    }
}