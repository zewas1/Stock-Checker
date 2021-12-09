<?php

namespace App\Entity;

use App\Repository\StockInformationRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass=StockInformationRepository::class)
 */
class StockInformation
{
    /**
     * @JMS\Type("int")
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private int $id;

    /**
     * @JMS\Type("float")
     *
     * @ORM\Column(type="float", nullable=true)
     *
     * @var float
     */
    private float $change;

    /**
     * @JMS\Type("float")
     *
     * @ORM\Column(name="change_percent", type="float", nullable=true)
     *
     * @var float
     */
    private float $changePercent;

    /**
     * @JMS\Type("string")
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private string $companyName;

    /**
     * @JMS\Type("string")
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private string $currency;

    /**
     * @JMS\Type("float")
     *
     * @ORM\Column(name="latest_price", type="float", nullable=true)
     *
     * @var float
     */
    private float $latestPrice;

    /**
     * @JMS\Type("string")
     *
     * @ORM\Column(type="string", length=10)
     *
     * @var string
     */
    private string $symbol;

    /**
     * @JMS\Type("float")
     *
     * @ORM\Column(name="year_high", type="float", nullable=true)
     *
     * @var float
     */
    private float $yearHigh;

    /**
     * @JMS\Type("float")
     *
     * @ORM\Column(name="year_low", type="float", nullable=true)
     *
     * @var float
     */
    private float $yearLow;

    /**
     * @JMS\Type("float")
     *
     * @ORM\Column(name="ytd_change", type="float", nullable=true)
     *
     * @var float
     */
    private float $ytdChange;

    /**
     * @JMS\Type("bool")
     *
     * @ORM\Column(name="is_us_market_open", type="boolean")
     *
     * @var bool
     */
    private bool $isUsMarketOpen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChange(): ?float
    {
        return $this->change;
    }

    public function setChange(?float $change): self
    {
        $this->change = $change;

        return $this;
    }

    public function getChangePercent(): ?float
    {
        return $this->changePercent;
    }

    public function setChangePercent(?float $changePercent): self
    {
        $this->changePercent = $changePercent;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getLatestPrice(): ?float
    {
        return $this->latestPrice;
    }

    public function setLatestPrice(?float $latestPrice): self
    {
        $this->latestPrice = $latestPrice;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getYearHigh(): ?float
    {
        return $this->yearHigh;
    }

    public function setYearHigh(?float $yearHigh): self
    {
        $this->yearHigh = $yearHigh;

        return $this;
    }

    public function getYearLow(): ?float
    {
        return $this->yearLow;
    }

    public function setYearLow(?float $yearLow): self
    {
        $this->yearLow = $yearLow;

        return $this;
    }

    public function getYtdChange(): ?float
    {
        return $this->ytdChange;
    }

    public function setYtdChange(?float $ytdChange): self
    {
        $this->ytdChange = $ytdChange;

        return $this;
    }

    public function getIsUsMarketOpen(): ?bool
    {
        return $this->isUsMarketOpen;
    }

    public function setIsUsMarketOpen(bool $isUsMarketOpen): self
    {
        $this->isUsMarketOpen = $isUsMarketOpen;

        return $this;
    }
}
