<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Generic;

use Chargemap\OCPI\Common\Server\Errors\OcpiGenericClientError;

final class ParamValidator
{
    /**
     * @param array<string,string> $params
     * @return array<string,string>
     * @throws OcpiGenericClientError
     */
    public static function validate(array $params): array
    {
        foreach ($params as $name => $value) {
            if ($name === 'countryCode') {
                if (mb_strlen($value) !== 2) {
                    throw new OcpiGenericClientError('Country code should contain exactly 2 letters.');
                }
            } elseif ($name === 'partyId') {
                if (mb_strlen($value) !== 3) {
                    throw new OcpiGenericClientError('Party ID should contain exactly 3 characters.');
                }
            } elseif ($value === '' || mb_strlen($value) > 36) {
                throw new OcpiGenericClientError(sprintf('%s should contain between 1 and 36 characters.', $name));
            }
        }

        return $params;
    }
}

