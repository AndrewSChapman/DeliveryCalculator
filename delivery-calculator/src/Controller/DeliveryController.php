<?php

namespace App\Controller;

use App\Region\Repository\Region\RegionRepositoryInterface;
use App\Region\Type\RegionId;
use App\Supplier\Service\SupplierDeliveryEstimateServiceInterface;
use App\Supplier\Type\SupplierId;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeliveryController extends AbstractController
{
    /**
     * @Route("/api/delivery/calculate-delivery-date/{supplierId}/{regionId}/{orderDate}", name="calculate_delivery_date")
     */
    public function calculateDeliveryDate(
        SupplierDeliveryEstimateServiceInterface $supplierDeliveryEstimateService,
        $supplierId,
        $regionId,
        $orderDate
    ) {
        try {
            $supplierId = new SupplierId($supplierId);
            $deliveryRegionId = new RegionId($regionId);

            try {
                $orderDate = new \DateTimeImmutable($orderDate);
            } catch (\Exception $exception) {
                return $this->getErrorResponse('Order date is invalid. Format should be yyyy-mm-dd hh:mm:ss');
            }

            $deliveryDate = $supplierDeliveryEstimateService->getEstimatedDeliveryDate(
                $supplierId,
                $orderDate,
                $deliveryRegionId
            );

            return $this->getOkResponse(['delivery_date' => $deliveryDate]);
        } catch(\DomainException $exception) {
            return $this->getErrorResponse($exception->getMessage(), 400);
        } catch(\Exception $exception) {
            return $this->getErrorResponse($exception->getMessage(), 500);
        }
    }

    /**
     * @Route("/api/delivery/regions", name="get_delivery_regions")
     */
    public function getDeliveryRegions(RegionRepositoryInterface $regionRepository)
    {
        $regions = [];
        $regionCollection = $regionRepository->getRegions();

        foreach ($regionCollection as $region) {
            $regions[] = [
                'region_id' => $region->getId()->__toString(),
                'region_name' => $region->getName()->getValue()
            ];
        }

        return $this->getOkResponse($regions);
    }

    protected function getErrorResponse(string $message = '', int $errorCode = 400)
    {
        $responseData = [
            'error' => true,
            'message' => $message
        ];

        return $this->json($responseData, $errorCode);
    }

    protected function getOkResponse(array $data)
    {
        $responseData = [
            'error' => false,
            'data' => $data
        ];

        return $this->json($responseData, 200);
    }
}