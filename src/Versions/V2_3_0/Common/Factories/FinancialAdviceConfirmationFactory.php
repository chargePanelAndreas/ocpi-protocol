<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\FinancialAdviceConfirmation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\CaptureStatusCode;
use DateTime;
use stdClass;

class FinancialAdviceConfirmationFactory
{
    /**
     * @param stdClass[]|null $json
     * @return FinancialAdviceConfirmation[]|null
     */
    public static function arrayFromJsonArray(?array $json): ?array
    {
        if ($json === null) {
            return null;
        }

        $objects = [];
        foreach ($json as $jsonObject) {
            $objects[] = self::fromJson($jsonObject);
        }

        return $objects;
    }

    public static function fromJson(?stdClass $json): ?FinancialAdviceConfirmation
    {
        if ($json === null) {
            return null;
        }

        $eftData = [];
        foreach ($json->eft_data as $item) {
            $eftData[] = $item;
        }

        $object = new FinancialAdviceConfirmation(
            $json->id,
            $json->authorization_reference,
            PriceFactory::fromJson($json->total_costs),
            $json->currency,
            $eftData,
            new CaptureStatusCode($json->capture_status_code),
            new DateTime($json->last_updated),
            $json->capture_status_message ?? null
        );

        return $object;
    }
}
