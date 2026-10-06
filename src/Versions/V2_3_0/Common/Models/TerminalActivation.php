<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class TerminalActivation implements JsonSerializable
{
    private ?string $terminalId;

    private ?string $customerReference;

    private ?string $partyId;

    private ?string $countryCode;

    private ?string $address;

    private ?string $city;

    private ?string $postalCode;

    private ?string $state;

    private ?string $country;

    private ?GeoLocation $coordinates;

    private ?string $invoiceBaseUrl;

    private ?InvoiceCreator $invoiceCreator;

    private ?string $reference;

    /** @var string[] */
    private array $locationIds = [];

    /** @var string[] */
    private array $evseUids = [];

    private DateTime $lastUpdated;

    public function __construct(
        DateTime $lastUpdated,
        ?string $terminalId,
        ?string $customerReference,
        ?string $partyId,
        ?string $countryCode,
        ?string $address,
        ?string $city,
        ?string $postalCode,
        ?string $state,
        ?string $country,
        ?GeoLocation $coordinates,
        ?string $invoiceBaseUrl,
        ?InvoiceCreator $invoiceCreator,
        ?string $reference
    )
    {
        $this->lastUpdated = $lastUpdated;
        $this->terminalId = $terminalId;
        $this->customerReference = $customerReference;
        $this->partyId = $partyId;
        $this->countryCode = $countryCode;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->state = $state;
        $this->country = $country;
        $this->coordinates = $coordinates;
        $this->invoiceBaseUrl = $invoiceBaseUrl;
        $this->invoiceCreator = $invoiceCreator;
        $this->reference = $reference;
    }

    public function getTerminalId(): ?string
    {
        return $this->terminalId;
    }

    public function getCustomerReference(): ?string
    {
        return $this->customerReference;
    }

    public function getPartyId(): ?string
    {
        return $this->partyId;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCoordinates(): ?GeoLocation
    {
        return $this->coordinates;
    }

    public function getInvoiceBaseUrl(): ?string
    {
        return $this->invoiceBaseUrl;
    }

    public function getInvoiceCreator(): ?InvoiceCreator
    {
        return $this->invoiceCreator;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @return string[]
     */
    public function getLocationIds(): array
    {
        return $this->locationIds;
    }

    public function addLocationId(string $locationId): self
    {
        $this->locationIds[] = $locationId;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getEvseUids(): array
    {
        return $this->evseUids;
    }

    public function addEvseUid(string $evseUid): self
    {
        $this->evseUids[] = $evseUid;

        return $this;
    }

    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'last_updated' => DateTimeFormatter::format($this->lastUpdated),
        ];

        if ($this->terminalId !== null) {
            $return['terminal_id'] = $this->terminalId;
        }

        if ($this->customerReference !== null) {
            $return['customer_reference'] = $this->customerReference;
        }

        if ($this->partyId !== null) {
            $return['party_id'] = $this->partyId;
        }

        if ($this->countryCode !== null) {
            $return['country_code'] = $this->countryCode;
        }

        if ($this->address !== null) {
            $return['address'] = $this->address;
        }

        if ($this->city !== null) {
            $return['city'] = $this->city;
        }

        if ($this->postalCode !== null) {
            $return['postal_code'] = $this->postalCode;
        }

        if ($this->state !== null) {
            $return['state'] = $this->state;
        }

        if ($this->country !== null) {
            $return['country'] = $this->country;
        }

        if ($this->coordinates !== null) {
            $return['coordinates'] = $this->coordinates;
        }

        if ($this->invoiceBaseUrl !== null) {
            $return['invoice_base_url'] = $this->invoiceBaseUrl;
        }

        if ($this->invoiceCreator !== null) {
            $return['invoice_creator'] = $this->invoiceCreator;
        }

        if ($this->reference !== null) {
            $return['reference'] = $this->reference;
        }

        if (count($this->locationIds) > 0) {
            $return['location_ids'] = $this->locationIds;
        }

        if (count($this->evseUids) > 0) {
            $return['evse_uids'] = $this->evseUids;
        }

        return $return;
    }
}
