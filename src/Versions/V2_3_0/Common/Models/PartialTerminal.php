<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\PartialModel;
use JsonSerializable;

/**
 * @method bool hasLocationIds()
 * @method self withLocationIds(?array $locationIds)
 * @method bool hasEvseUids()
 * @method self withEvseUids(?array $evseUids)
 */
class PartialTerminal extends PartialModel implements JsonSerializable
{
    /** @var string[] */
    private ?array $locationIds = null;
    /** @var string[] */
    private ?array $evseUids = null;

    protected function _withLocationIds(?array $locationIds): self
    {
        $this->locationIds = $locationIds;
        return $this;
    }

    protected function _withEvseUids(?array $evseUids): self
    {
        $this->evseUids = $evseUids;
        return $this;
    }

    public function getLocationIds(): ?array
    {
        return $this->locationIds;
    }

    public function getEvseUids(): ?array
    {
        return $this->evseUids;
    }

    public function jsonSerialize(): array
    {
        $return = [];

        if ($this->hasLocationIds()) {
            $return['location_ids'] = $this->locationIds ?? [];
        }
        if ($this->hasEvseUids()) {
            $return['evse_uids'] = $this->evseUids ?? [];
        }

        return $return;
    }
}
