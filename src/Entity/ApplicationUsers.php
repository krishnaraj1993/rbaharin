<?php

namespace App\Entity;

use App\Repository\ApplicationUsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationUsersRepository::class)
 */
class ApplicationUsers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $mobilenumber;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     */
    private $userId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $CreatedBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastActivityDate;

    /**
     * @ORM\ManyToOne(targetEntity=ApplicationUsers::class, inversedBy="ParentId")
     */
    private $subUsers;

    /**
     * @ORM\OneToMany(targetEntity=ApplicationUsers::class, mappedBy="subUsers")
     */
    private $ParentId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profileImage;

    /**
     * @ORM\ManyToOne(targetEntity=UserPlan::class)
     */
    private $currentPlan;

    /**
     * @ORM\Column(type="integer")
     */
    private $planStatus;

    /**
     * @ORM\ManyToOne(targetEntity=UserPlan::class)
     */
    private $prevPlan;

    public function __construct()
    {
        $this->ParentId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getMobilenumber(): ?string
    {
        return $this->mobilenumber;
    }

    public function setMobilenumber(string $mobilenumber): self
    {
        $this->mobilenumber = $mobilenumber;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->userId;
    }

    public function setUserId(?Users $userId): self
    {
        $this->userId = $userId;

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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->CreatedBy;
    }

    public function setCreatedBy(string $CreatedBy): self
    {
        $this->CreatedBy = $CreatedBy;

        return $this;
    }

    public function getLastActivityDate(): ?\DateTimeInterface
    {
        return $this->lastActivityDate;
    }

    public function setLastActivityDate(\DateTimeInterface $lastActivityDate): self
    {
        $this->lastActivityDate = $lastActivityDate;

        return $this;
    }

    public function getSubUsers(): ?self
    {
        return $this->subUsers;
    }

    public function setSubUsers(?self $subUsers): self
    {
        $this->subUsers = $subUsers;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profileImage;
    }

    public function setProfileImage(string $profileImage): self
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    public function getCurrentPlan(): ?UserPlan
    {
        return $this->currentPlan;
    }

    public function setCurrentPlan(?UserPlan $currentPlan): self
    {
        $this->currentPlan = $currentPlan;

        return $this;
    }

    public function getPlanStatus(): ?int
    {
        return $this->planStatus;
    }

    public function setPlanStatus(int $planStatus): self
    {
        $this->planStatus = $planStatus;

        return $this;
    }

    public function getPrevPlan(): ?UserPlan
    {
        return $this->prevPlan;
    }

    public function setPrevPlan(?UserPlan $prevPlan): self
    {
        $this->prevPlan = $prevPlan;

        return $this;
    }
}
