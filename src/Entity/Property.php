<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=PropertyStatus::class, inversedBy="properties")
     */
    private $propertyStatus;

    /**
     * @ORM\ManyToOne(targetEntity=PropertyType::class, inversedBy="properties")
     */
    private $propertyType;

    /**
     * @ORM\Column(type="integer")
     */
    private $investment;

    /**
     * @ORM\ManyToOne(targetEntity=Ewa::class, inversedBy="properties")
     */
    private $ewa;

    /**
     * @ORM\ManyToOne(targetEntity=Furnishing::class, inversedBy="properties")
     */
    private $furnishing;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $buildingName;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="properties")
     */
    private $Address;

    /**
     * @ORM\ManyToMany(targetEntity=NearBy::class, inversedBy="properties")
     */
    private $nearBy;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedRooms;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $BathRooms;

    /**
     * @ORM\Column(type="integer", length=45)
     */
    private $AreaWidth;

     /**
     * @ORM\Column(type="integer", length=45)
     */
    private $AreaHight;

    /**
     * @ORM\Column(type="date")
     */
    private $dateofupdated;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $map;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $Mortgage;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $features;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ApplicationAssets::class, mappedBy="property")
     */
    private $applicationAssets;

    /**
     * @ORM\OneToMany(targetEntity=PropertyDetails::class, mappedBy="parent")
     */
    private $propertyDetails;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    public function __construct()
    {
        $this->nearBy = new ArrayCollection();
        $this->applicationAssets = new ArrayCollection();
        $this->propertyDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPropertyStatus(): ?PropertyStatus
    {
        return $this->propertyStatus;
    }

    public function setPropertyStatus(?PropertyStatus $propertyStatus): self
    {
        $this->propertyStatus = $propertyStatus;

        return $this;
    }

    public function getPropertyType(): ?PropertyType
    {
        return $this->propertyType;
    }

    public function setPropertyType(?PropertyType $propertyType): self
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    public function getInvestment(): ?int
    {
        return $this->investment;
    }

    public function setInvestment(int $investment): self
    {
        $this->investment = $investment;

        return $this;
    }

    public function getEwa(): ?Ewa
    {
        return $this->ewa;
    }

    public function setEwa(?Ewa $ewa): self
    {
        $this->ewa = $ewa;

        return $this;
    }

    public function getFurnishing(): ?Furnishing
    {
        return $this->furnishing;
    }

    public function setFurnishing(?Furnishing $furnishing): self
    {
        $this->furnishing = $furnishing;

        return $this;
    }

    public function getBuildingName(): ?string
    {
        return $this->buildingName;
    }

    public function setBuildingName(string $buildingName): self
    {
        $this->buildingName = $buildingName;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    
    public function getAddress(): ?Address
    {
        return $this->Address;
    }

    public function setAddress(?Address $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return Collection|NearBy[]
     */
    public function getNearBy(): Collection
    {
        return $this->nearBy;
    }

    public function addNearBy(NearBy $nearBy): self
    {
        if (!$this->nearBy->contains($nearBy)) {
            $this->nearBy[] = $nearBy;
        }

        return $this;
    }

    public function removeNearBy(NearBy $nearBy): self
    {
        $this->nearBy->removeElement($nearBy);

        return $this;
    }

    public function getBedRooms(): ?int
    {
        return $this->bedRooms;
    }

    public function setBedRooms(int $bedRooms): self
    {
        $this->bedRooms = $bedRooms;

        return $this;
    }

    public function getBathRooms(): ?string
    {
        return $this->BathRooms;
    }

    public function setBathRooms(string $BathRooms): self
    {
        $this->BathRooms = $BathRooms;

        return $this;
    }

    public function getAreaWidth(): ?int
    {
        return $this->AreaWidth;
    }

    public function setAreaWidth(int $AreaWidth): self
    {
        $this->AreaWidth = $AreaWidth;

        return $this;
    }

    public function getAreaHeight(): ?int
    {
        return $this->AreaHeight;
    }

    public function setAreaHeight(int $AreaHeight): self
    {
        $this->AreaHeight = $AreaHeight;

        return $this;
    }

    public function getDateofupdated(): ?\DateTimeInterface
    {
        return $this->dateofupdated;
    }

    public function setDateofupdated(\DateTimeInterface $dateofupdated): self
    {
        $this->dateofupdated = $dateofupdated;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(string $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getMortgage(): ?string
    {
        return $this->Mortgage;
    }

    public function setMortgage(string $Mortgage): self
    {
        $this->Mortgage = $Mortgage;

        return $this;
    }

    public function getFeatures(): ?string
    {
        return $this->features;
    }

    public function setFeatures(string $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function getCreatedBy(): ?Users
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?Users $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|ApplicationAssets[]
     */
    public function getApplicationAssets(): Collection
    {
        return $this->applicationAssets;
    }

    public function addApplicationAsset(ApplicationAssets $applicationAsset): self
    {
        if (!$this->applicationAssets->contains($applicationAsset)) {
            $this->applicationAssets[] = $applicationAsset;
            $applicationAsset->setProperty($this);
        }

        return $this;
    }

    public function removeApplicationAsset(ApplicationAssets $applicationAsset): self
    {
        if ($this->applicationAssets->removeElement($applicationAsset)) {
            // set the owning side to null (unless already changed)
            if ($applicationAsset->getProperty() === $this) {
                $applicationAsset->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PropertyDetails[]
     */
    public function getPropertyDetails(): Collection
    {
        return $this->propertyDetails;
    }

    public function addPropertyDetail(PropertyDetails $propertyDetail): self
    {
        if (!$this->propertyDetails->contains($propertyDetail)) {
            $this->propertyDetails[] = $propertyDetail;
            $propertyDetail->setParent($this);
        }

        return $this;
    }

    public function removePropertyDetail(PropertyDetails $propertyDetail): self
    {
        if ($this->propertyDetails->removeElement($propertyDetail)) {
            // set the owning side to null (unless already changed)
            if ($propertyDetail->getParent() === $this) {
                $propertyDetail->setParent(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
