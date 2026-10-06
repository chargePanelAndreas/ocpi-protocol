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
 * @method bool hasLocationId()
 * @method self withLocationId(?string $locationId)
 * @method bool hasBookingTokens()
 * @method self withBookingTokens(?array $bookingTokens)
 * @method bool hasTariffIds()
 * @method self withTariffIds(?array $tariffIds)
 * @method bool hasPeriod()
 * @method self withPeriod(?Timeslot $period)
 * @method bool hasReservationStatus()
 * @method self withReservationStatus(?ReservationStatus $reservationStatus)
 * @method bool hasCanceled()
 * @method self withCanceled(?Cancellation $canceled)
 * @method bool hasAccessInformation()
 * @method self withAccessInformation(?array $accessInformation)
 * @method bool hasAuthorizationReference()
 * @method self withAuthorizationReference(?string $authorizationReference)
 * @method bool hasBookingTerms()
 * @method self withBookingTerms(?BookingTerms $bookingTerms)
 * @method bool hasBookingRequests()
 * @method self withBookingRequests(?array $bookingRequests)
 * @method bool hasLastUpdated()
 * @method self withLastUpdated(?DateTime $lastUpdated)
 */
class PartialBooking extends PartialModel implements JsonSerializable
{
    private ?BookingOption $bookingOption = null;
    private ?string $locationId = null;
    /** @var BookingToken[] */
    private ?array $bookingTokens = null;
    /** @var string[] */
    private ?array $tariffIds = null;
    private ?Timeslot $period = null;
    private ?ReservationStatus $reservationStatus = null;
    private ?Cancellation $canceled = null;
    /** @var AccessInformation[] */
    private ?array $accessInformation = null;
    private ?string $authorizationReference = null;
    private ?BookingTerms $bookingTerms = null;
    /** @var BookingRequestStatus[] */
    private ?array $bookingRequests = null;
    private ?DateTime $lastUpdated = null;

    protected function _withBookingOption(?BookingOption $bookingOption): self
    {
        $this->bookingOption = $bookingOption;
        return $this;
    }

    protected function _withLocationId(?string $locationId): self
    {
        $this->locationId = $locationId;
        return $this;
    }

    protected function _withBookingTokens(?array $bookingTokens): self
    {
        $this->bookingTokens = $bookingTokens;
        return $this;
    }

    protected function _withTariffIds(?array $tariffIds): self
    {
        $this->tariffIds = $tariffIds;
        return $this;
    }

    protected function _withPeriod(?Timeslot $period): self
    {
        $this->period = $period;
        return $this;
    }

    protected function _withReservationStatus(?ReservationStatus $reservationStatus): self
    {
        $this->reservationStatus = $reservationStatus;
        return $this;
    }

    protected function _withCanceled(?Cancellation $canceled): self
    {
        $this->canceled = $canceled;
        return $this;
    }

    protected function _withAccessInformation(?array $accessInformation): self
    {
        $this->accessInformation = $accessInformation;
        return $this;
    }

    protected function _withAuthorizationReference(?string $authorizationReference): self
    {
        $this->authorizationReference = $authorizationReference;
        return $this;
    }

    protected function _withBookingTerms(?BookingTerms $bookingTerms): self
    {
        $this->bookingTerms = $bookingTerms;
        return $this;
    }

    protected function _withBookingRequests(?array $bookingRequests): self
    {
        $this->bookingRequests = $bookingRequests;
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

    public function getLocationId(): ?string
    {
        return $this->locationId;
    }

    public function getBookingTokens(): ?array
    {
        return $this->bookingTokens;
    }

    public function getTariffIds(): ?array
    {
        return $this->tariffIds;
    }

    public function getPeriod(): ?Timeslot
    {
        return $this->period;
    }

    public function getReservationStatus(): ?ReservationStatus
    {
        return $this->reservationStatus;
    }

    public function getCanceled(): ?Cancellation
    {
        return $this->canceled;
    }

    public function getAccessInformation(): ?array
    {
        return $this->accessInformation;
    }

    public function getAuthorizationReference(): ?string
    {
        return $this->authorizationReference;
    }

    public function getBookingTerms(): ?BookingTerms
    {
        return $this->bookingTerms;
    }

    public function getBookingRequests(): ?array
    {
        return $this->bookingRequests;
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
        if ($this->hasLocationId()) {
            $return['location_id'] = $this->locationId;
        }
        if ($this->hasBookingTokens()) {
            $return['booking_tokens'] = $this->bookingTokens ?? [];
        }
        if ($this->hasTariffIds()) {
            $return['tariff_ids'] = $this->tariffIds ?? [];
        }
        if ($this->hasPeriod()) {
            $return['period'] = $this->period;
        }
        if ($this->hasReservationStatus()) {
            $return['reservation_status'] = $this->reservationStatus;
        }
        if ($this->hasCanceled()) {
            $return['canceled'] = $this->canceled;
        }
        if ($this->hasAccessInformation()) {
            $return['access_information'] = $this->accessInformation ?? [];
        }
        if ($this->hasAuthorizationReference()) {
            $return['authorization_reference'] = $this->authorizationReference;
        }
        if ($this->hasBookingTerms()) {
            $return['booking_terms'] = $this->bookingTerms;
        }
        if ($this->hasBookingRequests()) {
            $return['booking_requests'] = $this->bookingRequests ?? [];
        }
        if ($this->hasLastUpdated()) {
            $return['last_updated'] = $this->lastUpdated === null ? null : DateTimeFormatter::format($this->lastUpdated);
        }

        return $return;
    }
}
