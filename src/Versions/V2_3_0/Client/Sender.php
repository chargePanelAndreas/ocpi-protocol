<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Bookings;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Payments;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\ChargingProfiles;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\HubClientInfo;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Cdrs;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Commands;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Locations;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Sessions;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Tariffs;
use Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Tokens;

class Sender extends AbstractFeatures
{

    private Commands $commands;

    private Credentials $credentials;

    private Locations $locations;

    private Tokens $tokens;

    private Cdrs $cdrs;

    private Tariffs $tariffs;

    private Versions $versions;
    
    private Sessions $sessions;

    private Bookings $bookings;

    private Payments $payments;

    private ChargingProfiles $chargingProfiles;

    private HubClientInfo $hubClientInfo;

    public function credentials(): Credentials
    {
        if (!isset($this->credentials)) {
            $this->credentials = new Credentials($this->ocpiConfiguration);
        }

        return $this->credentials;
    }

    public function locations(): Locations
    {
        if (!isset($this->locations)) {
            $this->locations = new Locations($this->ocpiConfiguration);
        }

        return $this->locations;
    }

    public function tokens(): Tokens
    {
        if (!isset($this->tokens)) {
            $this->tokens = new Tokens($this->ocpiConfiguration);
        }

        return $this->tokens;
    }

    public function cdrs(): Cdrs
    {
        if (!isset($this->cdrs)) {
            $this->cdrs = new Cdrs($this->ocpiConfiguration);
        }

        return $this->cdrs;
    }

    public function tariffs(): Tariffs
    {
        if (!isset($this->tariffs)) {
            $this->tariffs = new Tariffs($this->ocpiConfiguration);
        }

        return $this->tariffs;
    }

    public function versions(): Versions
    {
        if(!isset($this->versions)) {
            $this->versions = new Versions($this->ocpiConfiguration);
        }

        return $this->versions;
    }

    public function sessions(): Sessions
    {
        if(!isset($this->sessions)) {
            $this->sessions = new Sessions($this->ocpiConfiguration);
        }

        return $this->sessions;
    }

    public function commands(): Commands
    {
        if (!isset($this->commands)) {
            $this->commands = new Commands($this->ocpiConfiguration);
        }

        return $this->commands;
    }

    public function bookings(): Bookings
    {
        if (!isset($this->bookings)) {
            $this->bookings = new Bookings($this->ocpiConfiguration);
        }

        return $this->bookings;
    }

    public function payments(): Payments
    {
        if (!isset($this->payments)) {
            $this->payments = new Payments($this->ocpiConfiguration);
        }

        return $this->payments;
    }

    public function chargingProfiles(): ChargingProfiles
    {
        if (!isset($this->chargingProfiles)) {
            $this->chargingProfiles = new ChargingProfiles($this->ocpiConfiguration);
        }

        return $this->chargingProfiles;
    }

    public function hubClientInfo(): HubClientInfo
    {
        if (!isset($this->hubClientInfo)) {
            $this->hubClientInfo = new HubClientInfo($this->ocpiConfiguration);
        }

        return $this->hubClientInfo;
    }
}
