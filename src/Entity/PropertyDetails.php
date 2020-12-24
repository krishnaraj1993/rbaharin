<?php

namespace App\Entity;

use App\Repository\PropertyDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyDetailsRepository::class)
 */
class PropertyDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $SeoTags;

    /**
     * @ORM\Column(type="date")
     */
    private $PlanUpdatedDate;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="propertyDetails")
     */
    private $parent;

    /**
     * @ORM\Column(type="integer")
     */
    private $webFeaturedListing;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $perpose;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeoTags(): ?string
    {
        return $this->SeoTags;
    }

    public function setSeoTags(string $SeoTags): self
    {
        $this->SeoTags = $SeoTags;

        return $this;
    }

    public function getPlanUpdatedDate(): ?\DateTimeInterface
    {
        return $this->PlanUpdatedDate;
    }

    public function setPlanUpdatedDate(\DateTimeInterface $PlanUpdatedDate): self
    {
        $this->PlanUpdatedDate = $PlanUpdatedDate;

        return $this;
    }

    public function getParent(): ?Property
    {
        return $this->parent;
    }

    public function setParent(?Property $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getWebFeaturedListing(): ?int
    {
        return $this->webFeaturedListing;
    }

    public function setWebFeaturedListing(int $webFeaturedListing): self
    {
        $this->webFeaturedListing = $webFeaturedListing;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getPerpose(): ?string
    {
        return $this->perpose;
    }

    public function setPerpose(string $perpose): self
    {
        $this->perpose = $perpose;

        return $this;
    }
}
