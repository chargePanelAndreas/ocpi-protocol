<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use Chargemap\OCPI\Common\Utils\PartialModel;
use DateTime;
use JsonSerializable;

/**
 * @method bool hasBookingOption()
 * @method self withBookingOption(?BookingOption $bookingOption)
 * @method bool hasPolicy()
 * @method self withPolicy(?Policy $policy)
 * @method bool hasTariffIds()
 * @method self withTariffIds(?array $tariffIds)
 * @method bool hasBookingTerms()
 * @method self withBookingTerms(?BookingTerms $bookingTerms)
 * @method bool hasCalendars()
 * @method self withCalendars(?array $calendars)
 * @method bool hasLastUpdated()
 * @method self withLastUpdated(?DateTime $lastUpdated)
 */
class PartialBookingLocation extends PartialModel implements JsonSerializable
{
    private ?BookingOption $bookingOption = null;
    private ?Policy $policy = null;
    /** @var string[] */
    private ?array $tariffIds = null;
    private ?BookingTerms $bookingTerms = null;
    /** @var Calendar[] */
    private ?array $calendars = null;
    private ?DateTime $lastUpdated = null;

    protected function _withBookingOption(?BookingOption $bookingOption): self
    {
        $this->bookingOption = $bookingOption;
        return $this;
    }

    protected function _withPolicy(?Policy $policy): self
    {
        $this->policy = $policy;
        return $this;
    }

    protected function _withTariffIds(?array $tariffIds): self
    {
        $this->tariffIds = $tariffIds;
        return $this;
    }

    protected function _withBookingTerms(?BookingTerms $bookingTerms): self
    {
        $this->bookingTerms = $bookingTerms;
        return $this;
    }

    protected function _withCalendars(?array $calendars): self
    {
        $this->calendars = $calendars;
        return $this;
    }

    protected function _withLastUpdated(?DateTime $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    public function getBookingOption(): ?BookingOption
    {
        return $this->bookingOption;
    }

    public function getPolicy(): ?Policy
    {
        return $this->policy;
    }

    public function getTariffIds(): ?array
    {
        return $this->tariffIds;
    }

    public function getBookingTerms(): ?BookingTerms
    {
        return $this->bookingTerms;
    }

    public function getCalendars(): ?array
    {
        return $this->calendars;
    }

    public function getLastUpdated(): ?DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [];

        if ($this->hasBookingOption()) {
            $return['booking_option'] = $this->bookingOption;
        }
        if ($this->hasPolicy()) {
            $return['policy'] = $this->policy;
        }
        if ($this->hasTariffIds()) {
            $return['tariff_ids'] = $this->tariffIds ?? [];
        }
        if ($this->hasBookingTerms()) {
            $return['booking_terms'] = $this->bookingTerms;
        }
        if ($this->hasCalendars()) {
            $return['calendars'] = $this->calendars ?? [];
        }
        if ($this->hasLastUpdated()) {
            $return['last_updated'] = $this->lastUpdated === null ? null : DateTimeFormatter::format($this->lastUpdated);
        }

        return $return;
    }
}
