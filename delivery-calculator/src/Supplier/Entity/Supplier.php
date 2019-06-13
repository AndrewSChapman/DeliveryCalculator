<?php
namespace App\Supplier\Entity;

use App\Core\Type\CreatedAt;
use App\Core\Type\UpdatedAt;
use App\Core\Type\WholeNumber;
use App\Supplier\Type\SupplierId;
use App\Supplier\Type\SupplierName;

class Supplier
{
    /** @var SupplierId */
    private $id;

    /** @var SupplierName */
    private $name;

    /** @var WholeNumber */
    private $defaultDeliveryDays;

    /** @var CreatedAt */
    private $createdAt;

    /** @var UpdatedAt */
    private $updatedAt;

    public function __construct(
        SupplierId $id,
        SupplierName $name,
        WholeNumber $defaultDeliveryDays,
        CreatedAt $createdAt = null,
        UpdatedAt $updatedAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->defaultDeliveryDays = $defaultDeliveryDays;
        $this->createdAt = $createdAt ?? new CreatedAt();
        $this->updatedAt = $updatedAt ?? new UpdatedAt();
    }

    /**
     * @return SupplierId
     */
    public function getId(): SupplierId
    {
        return $this->id;
    }

    /**
     * @return SupplierName
     */
    public function getName(): SupplierName
    {
        return $this->name;
    }

    public function getDefaultDeliveryDays(): WholeNumber
    {
        return $this->defaultDeliveryDays;
    }

    /**
     * @return CreatedAt
     */
    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    /**
     * @return UpdatedAt
     */
    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }
}