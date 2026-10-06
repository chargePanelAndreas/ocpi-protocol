<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Generic;

use Chargemap\OCPI\Common\Server\OcpiListingRequest;
use Chargemap\OCPI\Common\Server\OcpiListingResponse;
use JsonSerializable;

/**
 * Successful paginated response containing a list of objects.
 */
class ListingResponse extends OcpiListingResponse
{
    /** @var JsonSerializable[] */
    private array $items = [];

    public function __construct(OcpiListingRequest $listingRequest, int $totalCount, int $limit, ?string $statusMessage = null)
    {
        parent::__construct($listingRequest, $totalCount, $limit, $statusMessage);
    }

    public function addItem(JsonSerializable $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return JsonSerializable[]
     */
    public function getData(): array
    {
        return $this->items;
    }
}

