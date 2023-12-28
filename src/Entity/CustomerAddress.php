<?php

namespace App\Entity;

use App\Repository\CustomerAddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CustomerAddressRepository::class)]
class CustomerAddress
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $AddressLineOne;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $addressLineTwo;

    #[ORM\Column(type: 'integer')]
    private ?int $zip;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $country;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'address')]
    private ?Customer $customer;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getAddressLineOne(): ?string
    {
        return $this->AddressLineOne;
    }

    public function setAddressLineOne(string $AddressLineOne): self
    {
        $this->AddressLineOne = $AddressLineOne;

        return $this;
    }

    public function getAddressLineTwo(): ?string
    {
        return $this->addressLineTwo;
    }

    public function setAddressLineTwo(?string $addressLineTwo): self
    {
        $this->addressLineTwo = $addressLineTwo;

        return $this;
    }

    public function getZip(): ?int
    {
        return $this->zip;
    }

    public function setZip(int $zip): self
    {
        $this->zip = $zip;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
