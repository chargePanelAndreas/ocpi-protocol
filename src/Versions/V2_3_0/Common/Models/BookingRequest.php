<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class BookingRequest implements JsonSerializable
{
    private string $countryCode;

    private string $partyId;

    private string $requestId;

    private ?BookingOption $bookingOption;

    private string $locationId;

    private string $bookingLocationId;

    /** @var BookingToken[] */
    private array $tokens = [];

    /** @var AccessInformation[] */
    private array $accessInformation = [];

    private Period $period;

    private string $authorizationReference;

    private ?int $powerRequired;

    private ?Cancellation $canceled;

    public function __construct(
        string $countryCode,
        string $partyId,
        string $requestId,
        string $locationId,
        string $bookingLocationId,
        Period $period,
        string $authorizationReference,
        ?BookingOption $bookingOption,
        ?int $powerRequired,
        ?Cancellation $canceled
    )
    {
        $this->countryCode = $countryCode;
        $this->partyId = $partyId;
        $this->requestId = $requestId;
        $this->locationId = $locationId;
        $this->bookingLocationId = $bookingLocationId;
        $this->period = $period;
        $this->authorizationReference = $authorizationReference;
        $this->bookingOption = $bookingOption;
        $this->powerRequired = $powerRequired;
        $this->canceled = $canceled;
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

    public function getBookingLocationId(): string
    {
        return $this->bookingLocationId;
    }

    /**
     * @return BookingToken[]
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    public function addToken(BookingToken $token): self
    {
        $this->tokens[] = $token;

        return $this;
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

    public function getPeriod(): Period
    {
        return $this->period;
    }

    public function getAuthorizationReference(): string
    {
        return $this->authorizationReference;
    }

    public function getPowerRequired(): ?int
    {
        return $this->powerRequired;
    }

    public function getCanceled(): ?Cancellation
    {
        return $this->canceled;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'country_code' => $this->countryCode,
            'party_id' => $this->partyId,
            'request_id' => $this->requestId,
            'location_id' => $this->locationId,
            'booking_location_id' => $this->bookingLocationId,
            'period' => $this->period,
            'authorization_reference' => $this->authorizationReference,
        ];

        if ($this->bookingOption !== null) {
            $return['booking_option'] = $this->bookingOption;
        }

        if (count($this->tokens) > 0) {
            $return['tokens'] = $this->tokens;
        }

        if (count($this->accessInformation) > 0) {
            $return['access_information'] = $this->accessInformation;
        }

        if ($this->powerRequired !== null) {
            $return['power_required'] = $this->powerRequired;
        }

        if ($this->canceled !== null) {
            $return['canceled'] = $this->canceled;
        }

        return $return;
    }
}
