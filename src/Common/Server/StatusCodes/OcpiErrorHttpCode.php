<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Common\Server\StatusCodes;

/**
 * @method static self HTTP_BAD_REQUEST()
 * @method static self HTTP_UNAUTHORIZED()
 * @method static self HTTP_FORBIDDEN()
 * @method static self HTTP_NOT_FOUND()
 * @method static self HTTP_METHOD_NOT_ALLOWED()
 */
class OcpiErrorHttpCode extends OcpiHttpCode
{
    public const HTTP_OK = 200;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_METHOD_NOT_ALLOWED = 405;
}
