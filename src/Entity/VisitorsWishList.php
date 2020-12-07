<?php

namespace App\Entity;

use App\Repository\VisitorsWishListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitorsWishListRepository::class)
 */
class VisitorsWishList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfAdded;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=Visitors::class, cascade={"persist", "remove"})
     */
    private $parentId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfAdded(): ?\DateTimeInterface
    {
        return $this->dateOfAdded;
    }

    public function setDateOfAdded(\DateTimeInterface $dateOfAdded): self
    {
        $this->dateOfAdded = $dateOfAdded;

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

    public function getParentId(): ?Visitors
    {
        return $this->parentId;
    }

    public function setParentId(?Visitors $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }
}
