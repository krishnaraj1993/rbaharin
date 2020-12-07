<?php

namespace App\Entity;

use App\Repository\UserPlanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserPlanRepository::class)
 */
class UserPlan
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
    private $title;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $bhd;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $sixMonthPackage;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $annualPackage;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $promoAnnual;

    /**
     * @ORM\Column(type="integer")
     */
    private $listing;

    /**
     * @ORM\Column(type="boolean")
     */
    private $crm;

    /**
     * @ORM\Column(type="integer")
     */
    private $agents;

    /**
     * @ORM\Column(type="integer")
     */
    private $Fetured;

    /**
     * @ORM\Column(type="integer")
     */
    private $premium;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getBhd(): ?string
    {
        return $this->bhd;
    }

    public function setBhd(string $bhd): self
    {
        $this->bhd = $bhd;

        return $this;
    }

    public function getSixMonthPackage(): ?string
    {
        return $this->sixMonthPackage;
    }

    public function setSixMonthPackage(string $sixMonthPackage): self
    {
        $this->sixMonthPackage = $sixMonthPackage;

        return $this;
    }

    public function getAnnualPackage(): ?string
    {
        return $this->annualPackage;
    }

    public function setAnnualPackage(string $annualPackage): self
    {
        $this->annualPackage = $annualPackage;

        return $this;
    }

    public function getPromoAnnual(): ?string
    {
        return $this->promoAnnual;
    }

    public function setPromoAnnual(string $promoAnnual): self
    {
        $this->promoAnnual = $promoAnnual;

        return $this;
    }

    public function getListing(): ?int
    {
        return $this->listing;
    }

    public function setListing(int $listing): self
    {
        $this->listing = $listing;

        return $this;
    }

    public function getCrm(): ?bool
    {
        return $this->crm;
    }

    public function setCrm(bool $crm): self
    {
        $this->crm = $crm;

        return $this;
    }

    public function getAgents(): ?int
    {
        return $this->agents;
    }

    public function setAgents(int $agents): self
    {
        $this->agents = $agents;

        return $this;
    }

    public function getFetured(): ?int
    {
        return $this->Fetured;
    }

    public function setFetured(int $Fetured): self
    {
        $this->Fetured = $Fetured;

        return $this;
    }

    public function getPremium(): ?int
    {
        return $this->premium;
    }

    public function setPremium(int $premium): self
    {
        $this->premium = $premium;

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
