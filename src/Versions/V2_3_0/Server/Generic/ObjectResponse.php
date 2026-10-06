<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Generic;

use Chargemap\OCPI\Common\Server\OcpiSuccessResponse;
use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;
use JsonSerializable;

/**
 * Successful response containing a single object (or no data when null).
 */
class ObjectResponse extends OcpiSuccessResponse
{
    /** @var JsonSerializable|array|string|null */
    private $data;

    /**
     * @param JsonSerializable|array|string|null $data
     */
    public function __construct($data = null, ?string $statusMessage = null, ?OcpiSuccessHttpCode $httpCode = null)
    {
        parent::__construct($httpCode ?? OcpiSuccessHttpCode::HTTP_OK(), $statusMessage);
        $this->data = $data;
    }

    public static function created($data = null, ?string $statusMessage = null): self
    {
        return new self($data, $statusMessage, OcpiSuccessHttpCode::HTTP_CREATED());
    }

    protected function getData()
    {
        return $this->data;
    }
}

