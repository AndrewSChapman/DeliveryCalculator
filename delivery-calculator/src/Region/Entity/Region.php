<?php
namespace App\Region\Entity;

use App\Region\Type\RegionId;
use App\Region\Type\RegionName;

class Region
{
    /** @var RegionId */
    private $id;

    /** @var RegionName */
    private $name;

    /**
     * Supplier constructor.
     * @param RegionId $id
     * @param RegionName $name
     */
    public function __construct(
        RegionId $id,
        RegionName $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): RegionId
    {
        return $this->id;
    }

    public function getName(): RegionName
    {
        return $this->name;
    }
}