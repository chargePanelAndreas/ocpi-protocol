<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Models\OpenEnum;

/**
 * @method static self AD_HOC_USER()
 * @method static self APP_USER()
 * @method static self RFID()
 * @method static self OTHER()
 * @method static self EMAID()
 */
class TokenType extends OpenEnum
{
    public const AD_HOC_USER = 'AD_HOC_USER';
    public const APP_USER = 'APP_USER';
    public const EMAID = 'EMAID';
    public const RFID = 'RFID';
    public const OTHER = 'OTHER';
}
