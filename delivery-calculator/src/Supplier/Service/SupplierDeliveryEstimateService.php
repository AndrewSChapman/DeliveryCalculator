<?php

namespace App\Supplier\Service;

use App\Core\Data\Exception\ItemNotFoundException;
use App\Core\Type\DayNumber;
use App\Core\Type\Time;
use App\Region\Type\RegionId;
use App\Supplier\Repository\Supplier\SupplierRepositoryInterface;
use App\Supplier\Repository\SupplierDeliveryDay\SupplierDeliveryDayRepositoryInterface;
use App\Supplier\Repository\SupplierDeliveryRegion\SupplierDeliveryRegionRepositoryInterface;
use App\Supplier\Type\SupplierId;

class SupplierDeliveryEstimateService implements SupplierDeliveryEstimateServiceInterface
{
    /** @var SupplierRepositoryInterface */
    private $supplierRepository;

    /** @var SupplierDeliveryDayRepositoryInterface */
    private $supplierDeliveryDayRepository;

    /** @var SupplierDeliveryRegionRepositoryInterface */
    private $supplierDeliveryRegionRepository;

    public function __construct(
        SupplierRepositoryInterface $supplierRepository,
        SupplierDeliveryDayRepositoryInterface $supplierDeliveryDayRepository,
        SupplierDeliveryRegionRepositoryInterface $supplierDeliveryRegionRepository
    ) {
        $this->supplierRepository = $supplierRepository;
        $this->supplierDeliveryDayRepository = $supplierDeliveryDayRepository;
        $this->supplierDeliveryRegionRepository = $supplierDeliveryRegionRepository;
    }

    public function getEstimatedDeliveryDate(
        SupplierId $supplierId,
        \DateTimeImmutable $orderDate,
        RegionId $deliveryRegionId
    ): \DateTimeImmutable {
        $orderDayOfWeek = new DayNumber(intval(date('w', $orderDate->getTimestamp())));
        $orderTime = Time::fromString(date('H:i:s', $orderDate->getTimestamp()));

        // Load the supplier
        $supplier = $this->supplierRepository->getSupplierById($supplierId);

        /**
         * Determine the number of business days required to fulfil this order
         */

        // Load all the delivery regions the supplier delivers to.
        $deliveryRegionCollection = $this->supplierDeliveryRegionRepository->getSupplierDeliveryRegionsForSupplier($supplierId);

        try {
            // Load the delivery region record for the specified region.
            $deliveryRegion = $deliveryRegionCollection->getByRegion($deliveryRegionId);
            $numBusinessDaysToDeliver = $deliveryRegion->getNumBusinessDaysToDeliver()->getValue();
        } catch (ItemNotFoundException $exception) {
            /**
             * If the supplier doesn't have a region delivery assignment for this region, use the
             * supplier delivery default.
             */
            $numBusinessDaysToDeliver = $supplier->getDefaultDeliveryDays()->getValue();
        }

        
    }
}