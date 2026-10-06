<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Common\Models;

use MyCLabs\Enum\Enum;

/**
 * Base class for OCPI "open enums": the constants are the values known by the specification,
 * but any other string value sent by a partner must be accepted and preserved.
 */
abstract class OpenEnum extends Enum
{
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

    public static function from($value): Enum
    {
        return new static($value);
    }

    /**
     * Whether the value is one of the values known by this version of the specification.
     */
    public function isKnown(): bool
    {
        return static::isValid($this->value);
    }

    public function getKey()
    {
        $key = static::search($this->value);

        return $key === false ? $this->value : $key;
    }
}

