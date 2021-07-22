<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 */
class Rate
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
    private $from_currency;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $to_currency;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromCurrency(): ?string
    {
        return $this->from_currency;
    }

    public function setFromCurrency(string $from_currency): self
    {
        $this->from_currency = $from_currency;

        return $this;
    }

    public function getToCurrency(): ?string
    {
        return $this->to_currency;
    }

    public function setToCurrency(string $to_currency): self
    {
        $this->to_currency = $to_currency;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
