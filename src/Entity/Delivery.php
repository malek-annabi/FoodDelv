<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

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
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=DeliveryGuy::class, cascade={"persist", "remove"})
     */
    private $deliveryguy;



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
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeliveryguy(): ?DeliveryGuy
    {
        return $this->deliveryguy;
    }

    public function setDeliveryguy(?DeliveryGuy $deliveryguy): self
    {
        $this->deliveryguy = $deliveryguy;

        return $this;
    }

}
