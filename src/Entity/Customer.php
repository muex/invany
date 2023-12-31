<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Mpdf\Tag\Address;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id;

    #[ORM\Column(type: 'integer')]
    private ?int $number;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $companyname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $fax;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $mobile;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $mail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $web;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $currency;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $taxid;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CustomerAddress::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $customeraddresses;

    public function __construct()
    {
        $this->customeraddresses = new ArrayCollection();
    }


    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(string $companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(?string $web): self
    {
        $this->web = $web;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getTaxid(): ?string
    {
        return $this->taxid;
    }

    public function setTaxid(?string $taxid): self
    {
        $this->taxid = $taxid;

        return $this;
    }

    /**
     * @return Collection<int, CustomerAddress>
     */
    public function getCustomeraddresses(): Collection
    {
        return $this->customeraddresses;
    }

    public function addCustomeraddress(CustomerAddress $customeraddress): static
    {
        if (!$this->customeraddresses->contains($customeraddress)) {
            $this->customeraddresses->add($customeraddress);
            $customeraddress->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomeraddress(CustomerAddress $customeraddress): static
    {
        if ($this->customeraddresses->removeElement($customeraddress)) {
            // set the owning side to null (unless already changed)
            if ($customeraddress->getCustomer() === $this) {
                $customeraddress->setCustomer(null);
            }
        }

        return $this;
    }

}
