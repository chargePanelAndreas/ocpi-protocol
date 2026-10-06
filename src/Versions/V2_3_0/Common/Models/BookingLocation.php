<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class BookingLocation implements JsonSerializable
{
    private string $countryCode;

    private string $partyId;

    private string $id;

    private string $locationId;

    private ?BookingOption $bookingOption;

    private ?Policy $policy;

    /** @var string[] */
    private array $tariffIds = [];

    private ?BookingTerms $bookingTerms;

    /** @var Calendar[] */
    private array $calendars = [];

    private DateTime $lastUpdated;

    public function __construct(
        string $countryCode,
        string $partyId,
        string $id,
        string $locationId,
        DateTime $lastUpdated,
        ?BookingOption $bookingOption,
        ?Policy $policy,
        ?BookingTerms $bookingTerms
    )
    {
        $this->countryCode = $countryCode;
        $this->partyId = $partyId;
        $this->id = $id;
        $this->locationId = $locationId;
        $this->lastUpdated = $lastUpdated;
        $this->bookingOption = $bookingOption;
        $this->policy = $policy;
        $this->bookingTerms = $bookingTerms;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getPartyId(): string
    {
        return $this->partyId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function getBookingOption(): ?BookingOption
    {
        return $this->bookingOption;
    }

    public function getPolicy(): ?Policy
    {
        return $this->policy;
    }

    /**
     * @return string[]
     */
    public function getTariffIds(): array
    {
        return $this->tariffIds;
    }

    public function addTariffId(string $tariffId): self
    {
        $this->tariffIds[] = $tariffId;

        return $this;
    }

    public function getBookingTerms(): ?BookingTerms
    {
        return $this->bookingTerms;
    }

    /**
     * @return Calendar[]
     */
    public function getCalendars(): array
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        $this->calendars[] = $calendar;

        return $this;
    }

    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'country_code' => $this->countryCode,
            'party_id' => $this->partyId,
            'id' => $this->id,
            'location_id' => $this->locationId,
            'last_updated' => DateTimeFormatter::format($this->lastUpdated),
        ];

        if ($this->bookingOption !== null) {
            $return['booking_option'] = $this->bookingOption;
        }

        if ($this->policy !== null) {
            $return['policy'] = $this->policy;
        }

        if (count($this->tariffIds) > 0) {
            $return['tariff_ids'] = $this->tariffIds;
        }

        if ($this->bookingTerms !== null) {
            $return['booking_terms'] = $this->bookingTerms;
        }

        if (count($this->calendars) > 0) {
            $return['calendars'] = $this->calendars;
        }

        return $return;
    }
}
