<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class FinancialAdviceConfirmation implements JsonSerializable
{
    private string $id;

    private string $authorizationReference;

    private Price $totalCosts;

    private string $currency;

    /** @var string[] */
    private array $eftData;

    private CaptureStatusCode $captureStatusCode;

    private ?string $captureStatusMessage;

    private DateTime $lastUpdated;

    public function __construct(
        string $id,
        string $authorizationReference,
        Price $totalCosts,
        string $currency,
        array $eftData,
        CaptureStatusCode $captureStatusCode,
        DateTime $lastUpdated,
        ?string $captureStatusMessage
    )
    {
        $this->id = $id;
        $this->authorizationReference = $authorizationReference;
        $this->totalCosts = $totalCosts;
        $this->currency = $currency;
        $this->eftData = $eftData;
        $this->captureStatusCode = $captureStatusCode;
        $this->lastUpdated = $lastUpdated;
        $this->captureStatusMessage = $captureStatusMessage;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAuthorizationReference(): string
    {
        return $this->authorizationReference;
    }

    public function getTotalCosts(): Price
    {
        return $this->totalCosts;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string[]
     */
    public function getEftData(): array
    {
        return $this->eftData;
    }

    public function getCaptureStatusCode(): CaptureStatusCode
    {
        return $this->captureStatusCode;
    }

    public function getCaptureStatusMessage(): ?string
    {
        return $this->captureStatusMessage;
    }

    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'id' => $this->id,
            'authorization_reference' => $this->authorizationReference,
            'total_costs' => $this->totalCosts,
            'currency' => $this->currency,
            'eft_data' => $this->eftData,
            'capture_status_code' => $this->captureStatusCode,
            'last_updated' => DateTimeFormatter::format($this->lastUpdated),
        ];

        if ($this->captureStatusMessage !== null) {
            $return['capture_status_message'] = $this->captureStatusMessage;
        }

        return $return;
    }
}
