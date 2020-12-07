<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $BuildingNo;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $Area;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $other;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="Address")
     */
    private $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildingNo(): ?string
    {
        return $this->BuildingNo;
    }

    public function setBuildingNo(string $BuildingNo): self
    {
        $this->BuildingNo = $BuildingNo;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->Area;
    }

    public function setArea(string $Area): self
    {
        $this->Area = $Area;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(string $other): self
    {
        $this->other = $other;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setAddress($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getAddress() === $this) {
                $property->setAddress(null);
            }
        }

        return $this;
    }
}
