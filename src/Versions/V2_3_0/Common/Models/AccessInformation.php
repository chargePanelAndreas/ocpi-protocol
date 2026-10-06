<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class AccessInformation implements JsonSerializable
{
    private AccessMethod $method;

    private ?string $value;

    public function __construct(
        AccessMethod $method,
        ?string $value
    )
    {
        $this->method = $method;
        $this->value = $value;
    }

    public function getMethod(): AccessMethod
    {
        return $this->method;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'method' => $this->method,
        ];

        if ($this->value !== null) {
            $return['value'] = $this->value;
        }

        return $return;
    }
}
