<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class Booking implements JsonSerializable
{
    private string $id;

    private string $countryCode;

    private string $partyId;

    private string $requestId;

    private ?BookingOption $bookingOption;

    private string $locationId;

    /** @var BookingToken[] */
    private array $bookingTokens = [];

    /** @var string[] */
    private array $tariffIds = [];

    private Timeslot $period;

    private ReservationStatus $reservationStatus;

    private ?Cancellation $canceled;

    /** @var AccessInformation[] */
    private array $accessInformation = [];

    private string $authorizationReference;

    private BookingTerms $bookingTerms;

    /** @var BookingRequestStatus[] */
    private array $bookingRequests;

    private DateTime $lastUpdated;

    public function __construct(
        string $id,
        string $countryCode,
        string $partyId,
        string $requestId,
        string $locationId,
        Timeslot $period,
        ReservationStatus $reservationStatus,
        string $authorizationReference,
        BookingTerms $bookingTerms,
        array $bookingRequests,
        DateTime $lastUpdated,
        ?BookingOption $bookingOption,
        ?Cancellation $canceled
    )
    {
        $this->id = $id;
        $this->countryCode = $countryCode;
        $this->partyId = $partyId;
        $this->requestId = $requestId;
        $this->locationId = $locationId;
        $this->period = $period;
        $this->reservationStatus = $reservationStatus;
        $this->authorizationReference = $authorizationReference;
        $this->bookingTerms = $bookingTerms;
        $this->bookingRequests = $bookingRequests;
        $this->lastUpdated = $lastUpdated;
        $this->bookingOption = $bookingOption;
        $this->canceled = $canceled;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getPartyId(): string
    {
        return $this->partyId;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function getBookingOption(): ?BookingOption
    {
        return $this->bookingOption;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    /**
     * @return BookingToken[]
     */
    public function getBookingTokens(): array
    {
        return $this->bookingTokens;
    }

    public function addBookingToken(BookingToken $bookingToken): self
    {
        $this->bookingTokens[] = $bookingToken;

        return $this;
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

    public function getPeriod(): Timeslot
    {
        return $this->period;
    }

    public function getReservationStatus(): ReservationStatus
    {
        return $this->reservationStatus;
    }

    public function getCanceled(): ?Cancellation
    {
        return $this->canceled;
    }

    /**
     * @return AccessInformation[]
     */
    public function getAccessInformation(): array
    {
        return $this->accessInformation;
    }

    public function addAccessInformation(AccessInformation $accessInformation): self
    {
        $this->accessInformation[] = $accessInformation;

        return $this;
    }

    public function getAuthorizationReference(): string
    {
        return $this->authorizationReference;
    }

    public function getBookingTerms(): BookingTerms
    {
        return $this->bookingTerms;
    }

    /**
     * @return BookingRequestStatus[]
     */
    public function getBookingRequests(): array
    {
        return $this->bookingRequests;
    }

    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'id' => $this->id,
            'country_code' => $this->countryCode,
            'party_id' => $this->partyId,
            'request_id' => $this->requestId,
            'location_id' => $this->locationId,
            'period' => $this->period,
            'reservation_status' => $this->reservationStatus,
            'authorization_reference' => $this->authorizationReference,
            'booking_terms' => $this->bookingTerms,
            'booking_requests' => $this->bookingRequests,
            'last_updated' => DateTimeFormatter::format($this->lastUpdated),
        ];

        if ($this->bookingOption !== null) {
            $return['booking_option'] = $this->bookingOption;
        }

        if (count($this->bookingTokens) > 0) {
            $return['booking_tokens'] = $this->bookingTokens;
        }

        if (count($this->tariffIds) > 0) {
            $return['tariff_ids'] = $this->tariffIds;
        }

        if ($this->canceled !== null) {
            $return['canceled'] = $this->canceled;
        }

        if (count($this->accessInformation) > 0) {
            $return['access_information'] = $this->accessInformation;
        }

        return $return;
    }
}
