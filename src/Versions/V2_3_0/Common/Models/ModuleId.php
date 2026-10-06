<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\BaseModuleId;

/**
 * @method static self CDRS()
 * @method static self COMMANDS()
 * @method static self CRED_AND_REG()
 * @method static self LOCATIONS()
 * @method static self SESSIONS()
 * @method static self TARIFFS()
 * @method static self TOKENS()
 * @method static self BOOKINGS()
 * @method static self PAYMENTS()
 */
class ModuleId extends BaseModuleId
{
    public const CDRS = 'cdrs';
    public const CHARGING_PROFILES = 'chargingprofiles';
    public const COMMANDS = 'commands';
    public const CRED_AND_REG = 'credentials';
    public const HUB_CLIENT_INFO = 'hubclientinfo';
    public const LOCATIONS = 'locations';
    public const SESSIONS = 'sessions';
    public const TARIFFS = 'tariffs';
    public const TOKENS = 'tokens';
    public const BOOKINGS = 'bookings';
    public const PAYMENTS = 'payments';

    public function __construct($value)
    {
        if ($value instanceof self) {
            $value = $value->getValue();
        }
        if (!is_string($value)) {
            throw new \UnexpectedValueException('Value must be a string for an open enum');
        }
        $this->value = $value;
    }

    public static function from($value): \MyCLabs\Enum\Enum
    {
        return new static($value);
    }
}
