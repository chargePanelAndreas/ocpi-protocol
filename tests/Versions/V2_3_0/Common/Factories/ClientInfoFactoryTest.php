<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory;
use PHPUnit\Framework\TestCase;
use Tests\Chargemap\OCPI\OcpiTestCase;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory
 */
class ClientInfoFactoryTest extends TestCase
{
    public function getJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/ClientInfo') as $file) {
            if ($file !== '.' && $file !== '..') {
                yield $file => [file_get_contents(__DIR__ . '/Payloads/ClientInfo/' . $file)];
            }
        }
    }

    /**
     * @dataProvider getJsonData
     */
    public function testFromJson(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);
        OcpiTestCase::coerce('V2_3_0/Common/client_info.schema.json', $json);

        $model = ClientInfoFactory::fromJson($json);

        $this->assertEquals($json, json_decode(json_encode($model)));
    }

    public function testFromNull(): void
    {
        $this->assertNull(ClientInfoFactory::fromJson(null));
    }
}
