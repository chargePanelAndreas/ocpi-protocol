<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\PriceFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Price;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PriceToken;
use DateTime;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \Chargemap\OCPI\Versions\V2_3_0\Common\Models\Price
 */
class PriceTest extends TestCase
{

     /**
     * @return mixed[][]
     */
    public function getJsonSerializeData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/Price') as $file) {
            if ($file !== '.' && $file !== '..') {
                yield $file => [
                    'payload' => json_decode(file_get_contents(__DIR__ . '/Payloads/Price/' . $file)),
                ];
            }
        }
    }

    /**
     * @param stdClass $payload
     * @dataProvider getJsonSerializeData()
     */
    public function testJsonSerialize(stdClass $payload): void
    {
        $cdrToken = PriceFactory::fromJson($payload);

        self::assertJsonSerialization($cdrToken, $payload);
    }

    public static function assertJsonSerialization(?Price $price, ?stdClass $json): void
    {
        if ($price === null) {
            Assert::assertNull($json);
        } else {
            Assert::assertEquals(json_decode(json_encode($price)), $json);
        }
    }
}