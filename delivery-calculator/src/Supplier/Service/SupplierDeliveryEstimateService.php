<?php

namespace App\Supplier\Service;

use App\Core\Data\Exception\ItemNotFoundException;
use App\Core\Type\DayNumber;
use App\Core\Type\Time;
use App\Core\Type\WholeNumber;
use App\Region\Type\RegionId;
use App\Supplier\Collection\SupplierDeliveryDayCollection;
use App\Supplier\Entity\Supplier;
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

    /**
     * Given a supplier, an order date and time, and a delivery region, this method calculates when the
     * order will be delivered and returns that delivery date as an ISODate string, e.g. '2019-06-17'
     */
    public function getEstimatedDeliveryDate(
        SupplierId $supplierId,
        \DateTimeImmutable $orderDate,
        RegionId $deliveryRegionId
    ): string {
        // Load the supplier
        $supplier = $this->supplierRepository->getSupplierById($supplierId);

        // Get the number of business days required for delivery by this supplier to this region.
        $numBusinessDaysToDeliver = $this->getNumDeliveryBusinessDaysForSupplierRegion($supplier, $deliveryRegionId);

        // Determine the day number that the order date calls on (0 is sunday, 6 is saturday)
        $orderDayOfWeek = new DayNumber(intval(date('w', $orderDate->getTimestamp())));

        // Get the time value from the order datetime, e.g. '09:45:15'
        $orderTime = Time::fromString(date('H:i:s', $orderDate->getTimestamp()));

        // Get the days of the week (and associated start/finish times) that the supplier actually delivers
        $supplierDeliveryDays = $this->supplierDeliveryDayRepository->getDeliveryDaysForSupplier($supplierId);

        $orderDayOfWeek->increment();

        // Is the date and time of order a valid business day?
        $orderDateIsBusinessDate = false;
        if ($this->isBusinessDay($supplierDeliveryDays, $orderDayOfWeek)) {
            $deliveryDay = $supplierDeliveryDays->getByDayNumber($orderDayOfWeek);
            if(!$deliveryDay->timeIsAfterEndTime($orderTime)) {
                $orderDateIsBusinessDate = true;
            }
        }

        // If the order date/time is not a valid business day, add an additional day to the num business delivery
        // days since the current day doesn't move the order.
        if (!$orderDateIsBusinessDate) {
            $numBusinessDaysToDeliver->increment();
        }

        // Calculate how many days in total from now will pass until delivery is satisfied.
        $numDaysUntilDelivery = $this->getNumDaysUntilDelivery(
            $supplierDeliveryDays,
            $numBusinessDaysToDeliver,
            $orderDayOfWeek
        );

        // Return the delivery date as an ISODate string.
        return date('Y-m-d', $orderDate->getTimestamp() + (86400 * $numDaysUntilDelivery->getValue()));
    }

    /**
     * Determines the number of business days required for the supplier to deliver
     * to the specified region.
     */
    private function getNumDeliveryBusinessDaysForSupplierRegion(
        Supplier $supplier,
        RegionId $deliveryRegionId
    ): WholeNumber {
        // Load all the delivery regions that the supplier delivers to.
        $deliveryRegionCollection =
            $this->supplierDeliveryRegionRepository->getSupplierDeliveryRegionsForSupplier($supplier->getId());

        // Load the delivery region record for the specified region.
        try {
            $deliveryRegion = $deliveryRegionCollection->getByRegion($deliveryRegionId);
            return $deliveryRegion->getNumBusinessDaysToDeliver();
        } catch (ItemNotFoundException $exception) {
            /**
             * If the supplier doesn't have a region delivery assignment for this region, use the
             * default delivery days value that the supplier has provided.
             */
            return $supplier->getDefaultDeliveryDays();
        }
    }

    /***
     * Calculates how many days in total will pass until delivery is satisfied.
     */
    private function getNumDaysUntilDelivery(
        SupplierDeliveryDayCollection $deliveryDayCollection,
        WholeNumber $numBusinessDays,
        DayNumber $startDayNo
    ): WholeNumber {
        $foundDeliveryDate = false;
        $currentDayNo = new DayNumber($startDayNo->getValue());

        $daysUntilDelivery = new WholeNumber(0);
        $daysRemaining = $numBusinessDays->getValue();

        while (!$foundDeliveryDate) {
            if ($this->isBusinessDay($deliveryDayCollection, $currentDayNo)) {
                $daysRemaining--;

                if ($daysRemaining === 0) {
                    $foundDeliveryDate = true;
                }
            }

            $currentDayNo->increment();
            $daysUntilDelivery->increment();
        }

        return $daysUntilDelivery;
    }

    /**
     * Determines whether of not the passed day number is a valid business day.
     */
    private function isBusinessDay(SupplierDeliveryDayCollection $deliveryDayCollection, DayNumber $dayNumber): bool
    {
        try {
            $deliveryDayCollection->getByDayNumber($dayNumber);
            return true;
        } catch (ItemNotFoundException $exception) {
            return false;
        }
    }
}