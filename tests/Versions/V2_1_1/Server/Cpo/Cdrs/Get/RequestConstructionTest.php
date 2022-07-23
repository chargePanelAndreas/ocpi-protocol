<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_1_1\Server\Cpo\Cdrs\Get;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use Chargemap\OCPI\Versions\V2_1_1\Server\Cpo\Cdrs\GetListing\OcpiCpoCdrGetListingRequest;
use DateTime;
use InvalidArgumentException;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_1_1\Server\Cpo\Cdrs\Get\OcpiCpoCdrGetListingRequest
 */
class RequestConstructionTest extends OcpiTestCase
{
    public function testShouldConstructWithoutDates(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface()
            ->withQueryParams(['offset' => '0', 'limit' => '10']);

        $request = new OcpiCpoCdrGetListingRequest($serverRequestInterface);
        $this->assertNull($request->getDateTo());
        $this->assertNull($request->getDateFrom());
    }

    public function testShouldConstructWithDateFrom(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface()
            ->withQueryParams(['offset' => '0', 'limit' => '10', 'date_from' => '2020-05-25']);

        $request = new OcpiCpoCdrGetListingRequest($serverRequestInterface);
        $this->assertSame(DateTimeFormatter::format((new DateTime('25-05-2020'))), DateTimeFormatter::format($request->getDateFrom()));
        $this->assertNull($request->getDateTo());
    }

    public function testShouldConstructWithDateTo(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface()
            ->withQueryParams(['offset' => '0', 'limit' => '10', 'date_to' => '25-05-2020']);

        $request = new OcpiCpoCdrGetListingRequest($serverRequestInterface);
        $this->assertSame(DateTimeFormatter::format((new DateTime('25-05-2020'))), DateTimeFormatter::format($request->getDateTo()));
        $this->assertNull($request->getDateFrom());
    }

    public function testShouldConstructWithDates(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface()
            ->withQueryParams(['offset' => '0', 'limit' => '10', 'date_from' => '25-05-2020', 'date_to' => '26-05-2020']);

        $request = new OcpiCpoCdrGetListingRequest($serverRequestInterface);
        $this->assertSame(DateTimeFormatter::format((new DateTime('25-05-2020'))), DateTimeFormatter::format($request->getDateFrom()));
        $this->assertSame(DateTimeFormatter::format((new DateTime('26-05-2020'))), DateTimeFormatter::format($request->getDateTo()));
    }

    public function testShouldThrowWithInvalidDates(): void
    {
        $serverRequestInterface = $this->createServerRequestInterface()
            ->withQueryParams(['offset' => '0', 'limit' => '10', 'date_from' => '26-05-2020', 'date_to' => '25-05-2020']);

        $this->expectException(InvalidArgumentException::class);
        new OcpiCpoCdrGetListingRequest($serverRequestInterface);
    }
}