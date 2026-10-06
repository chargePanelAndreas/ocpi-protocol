<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * @method static self SUCCESS()
 * @method static self PARTIAL_SUCCESS()
 * @method static self FAILED()
 */
class CaptureStatusCode extends Enum
{
    public const SUCCESS = 'SUCCESS';
    public const PARTIAL_SUCCESS = 'PARTIAL_SUCCESS';
    public const FAILED = 'FAILED';
}
