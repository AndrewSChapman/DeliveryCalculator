<?php
namespace App\Supplier\Entity;

use App\Core\Type\WholeNumber;
use App\Region\Type\RegionId;
use App\Supplier\Type\SupplierId;

class SupplierDeliveryRegion
{
    /** @var SupplierId */
    private $supplierId;

    /** @var RegionId */
    private $regionId;

    /** @var WholeNumber */
    private $numBusinessDaysToDeliver;

    public function __construct(
        SupplierId $id,
        RegionId $regionId,
        WholeNumber $numBusinessDaysToDeliver
    ) {
        $this->supplierId = $id;
        $this->regionId = $regionId;
        $this->numBusinessDaysToDeliver = $numBusinessDaysToDeliver;
    }

    public function getSupplierId(): SupplierId
    {
        return $this->supplierId;
    }

    public function getRegionId(): RegionId
    {
        return $this->regionId;
    }

    public function getNumBusinessDaysToDeliver(): WholeNumber
    {
        return $this->numBusinessDaysToDeliver;
    }
}