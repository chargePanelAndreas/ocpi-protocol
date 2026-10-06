<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class BookingTerms implements JsonSerializable
{
    private ?bool $rfidAuthRequired;

    private ?bool $tokenGroupsSupported;

    private ?bool $remoteAuthSupported;

    /** @var AccessMethod[] */
    private array $supportedAccessMethods;

    private float $changeUntilMinutes;

    private float $cancelUntilMinutes;

    private ?bool $changeNotAllowed;

    private ?bool $earlyStartAllowed;

    private ?float $earlyStartTime;

    private ?float $noshowTimeout;

    private ?bool $noshowFee;

    private ?bool $lateStopAllowed;

    private ?float $lateStopTime;

    private ?bool $overlappingBookingsAllowed;

    private ?float $minBookingDuration;

    private ?float $maxBookingDuration;

    private ?string $bookingTerms;

    public function __construct(
        array $supportedAccessMethods,
        float $changeUntilMinutes,
        float $cancelUntilMinutes,
        ?bool $rfidAuthRequired,
        ?bool $tokenGroupsSupported,
        ?bool $remoteAuthSupported,
        ?bool $changeNotAllowed,
        ?bool $earlyStartAllowed,
        ?float $earlyStartTime,
        ?float $noshowTimeout,
        ?bool $noshowFee,
        ?bool $lateStopAllowed,
        ?float $lateStopTime,
        ?bool $overlappingBookingsAllowed,
        ?float $minBookingDuration,
        ?float $maxBookingDuration,
        ?string $bookingTerms
    )
    {
        $this->supportedAccessMethods = $supportedAccessMethods;
        $this->changeUntilMinutes = $changeUntilMinutes;
        $this->cancelUntilMinutes = $cancelUntilMinutes;
        $this->rfidAuthRequired = $rfidAuthRequired;
        $this->tokenGroupsSupported = $tokenGroupsSupported;
        $this->remoteAuthSupported = $remoteAuthSupported;
        $this->changeNotAllowed = $changeNotAllowed;
        $this->earlyStartAllowed = $earlyStartAllowed;
        $this->earlyStartTime = $earlyStartTime;
        $this->noshowTimeout = $noshowTimeout;
        $this->noshowFee = $noshowFee;
        $this->lateStopAllowed = $lateStopAllowed;
        $this->lateStopTime = $lateStopTime;
        $this->overlappingBookingsAllowed = $overlappingBookingsAllowed;
        $this->minBookingDuration = $minBookingDuration;
        $this->maxBookingDuration = $maxBookingDuration;
        $this->bookingTerms = $bookingTerms;
    }

    public function getRfidAuthRequired(): ?bool
    {
        return $this->rfidAuthRequired;
    }

    public function getTokenGroupsSupported(): ?bool
    {
        return $this->tokenGroupsSupported;
    }

    public function getRemoteAuthSupported(): ?bool
    {
        return $this->remoteAuthSupported;
    }

    /**
     * @return AccessMethod[]
     */
    public function getSupportedAccessMethods(): array
    {
        return $this->supportedAccessMethods;
    }

    public function getChangeUntilMinutes(): float
    {
        return $this->changeUntilMinutes;
    }

    public function getCancelUntilMinutes(): float
    {
        return $this->cancelUntilMinutes;
    }

    public function getChangeNotAllowed(): ?bool
    {
        return $this->changeNotAllowed;
    }

    public function getEarlyStartAllowed(): ?bool
    {
        return $this->earlyStartAllowed;
    }

    public function getEarlyStartTime(): ?float
    {
        return $this->earlyStartTime;
    }

    public function getNoshowTimeout(): ?float
    {
        return $this->noshowTimeout;
    }

    public function getNoshowFee(): ?bool
    {
        return $this->noshowFee;
    }

    public function getLateStopAllowed(): ?bool
    {
        return $this->lateStopAllowed;
    }

    public function getLateStopTime(): ?float
    {
        return $this->lateStopTime;
    }

    public function getOverlappingBookingsAllowed(): ?bool
    {
        return $this->overlappingBookingsAllowed;
    }

    public function getMinBookingDuration(): ?float
    {
        return $this->minBookingDuration;
    }

    public function getMaxBookingDuration(): ?float
    {
        return $this->maxBookingDuration;
    }

    public function getBookingTerms(): ?string
    {
        return $this->bookingTerms;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'supported_access_methods' => $this->supportedAccessMethods,
            'change_until_minutes' => $this->changeUntilMinutes,
            'cancel_until_minutes' => $this->cancelUntilMinutes,
        ];

        if ($this->rfidAuthRequired !== null) {
            $return['rfid_auth_required'] = $this->rfidAuthRequired;
        }

        if ($this->tokenGroupsSupported !== null) {
            $return['token_groups_supported'] = $this->tokenGroupsSupported;
        }

        if ($this->remoteAuthSupported !== null) {
            $return['remote_auth_supported'] = $this->remoteAuthSupported;
        }

        if ($this->changeNotAllowed !== null) {
            $return['change_not_allowed'] = $this->changeNotAllowed;
        }

        if ($this->earlyStartAllowed !== null) {
            $return['early_start_allowed'] = $this->earlyStartAllowed;
        }

        if ($this->earlyStartTime !== null) {
            $return['early_start_time'] = $this->earlyStartTime;
        }

        if ($this->noshowTimeout !== null) {
            $return['noshow_timeout'] = $this->noshowTimeout;
        }

        if ($this->noshowFee !== null) {
            $return['noshow_fee'] = $this->noshowFee;
        }

        if ($this->lateStopAllowed !== null) {
            $return['late_stop_allowed'] = $this->lateStopAllowed;
        }

        if ($this->lateStopTime !== null) {
            $return['late_stop_time'] = $this->lateStopTime;
        }

        if ($this->overlappingBookingsAllowed !== null) {
            $return['overlapping_bookings_allowed'] = $this->overlappingBookingsAllowed;
        }

        if ($this->minBookingDuration !== null) {
            $return['min_booking_duration'] = $this->minBookingDuration;
        }

        if ($this->maxBookingDuration !== null) {
            $return['max_booking_duration'] = $this->maxBookingDuration;
        }

        if ($this->bookingTerms !== null) {
            $return['booking_terms'] = $this->bookingTerms;
        }

        return $return;
    }
}
