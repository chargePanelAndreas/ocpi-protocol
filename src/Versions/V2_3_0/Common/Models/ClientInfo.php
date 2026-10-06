<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class ClientInfo implements JsonSerializable
{
    private string $partyId;

    private string $countryCode;

    private Role $role;

    private ConnectionStatus $status;

    private DateTime $lastUpdated;

    public function __construct(
        string $partyId,
        string $countryCode,
        Role $role,
        ConnectionStatus $status,
        DateTime $lastUpdated
    )
    {
        $this->partyId = $partyId;
        $this->countryCode = $countryCode;
        $this->role = $role;
        $this->status = $status;
        $this->lastUpdated = $lastUpdated;
    }

    public function getPartyId(): string
    {
        return $this->partyId;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getStatus(): ConnectionStatus
    {
        return $this->status;
    }

    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'party_id' => $this->partyId,
            'country_code' => $this->countryCode,
            'role' => $this->role,
            'status' => $this->status,
            'last_updated' => DateTimeFormatter::format($this->lastUpdated),
        ];


        return $return;
    }
}
