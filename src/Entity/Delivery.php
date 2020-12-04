<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
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
    private $Location;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Time;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=DeliveryGuy::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $DeliveryGuy;

    /**
     * @ORM\ManyToMany(targetEntity=Food::class)
     */
    private $Food;

    public function __construct()
    {
        $this->Food = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->Time;
    }

    public function setTime(?\DateTimeInterface $Time): self
    {
        $this->Time = $Time;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getDeliveryGuy(): ?DeliveryGuy
    {
        return $this->DeliveryGuy;
    }

    public function setDeliveryGuy(?DeliveryGuy $DeliveryGuy): self
    {
        $this->DeliveryGuy = $DeliveryGuy;

        return $this;
    }

    /**
     * @return Collection|Food[]
     */
    public function getFood(): Collection
    {
        return $this->Food;
    }

    public function addFood(Food $food): self
    {
        if (!$this->Food->contains($food)) {
            $this->Food[] = $food;
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        $this->Food->removeElement($food);

        return $this;
    }
}
