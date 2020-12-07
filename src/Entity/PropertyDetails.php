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
}
