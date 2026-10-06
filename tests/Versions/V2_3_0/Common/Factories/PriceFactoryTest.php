<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\PriceFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Price;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use stdClass;

class PriceFactoryTest extends TestCase
{
    public function getFromJsonData(): iterable
    {
        foreach (scandir(__DIR__ . '/Payloads/Price/') as $filename) {
            if ($filename !== '.' && $filename !== '..') {
                yield $filename => [
                    'payload' => file_get_contents(__DIR__ . '/Payloads/Price/' . $filename),
                ];
            }
        }
    }

    /**
     * @param string $payload
     * @throws \JsonException
     * @dataProvider getFromJsonData()
     */
    public function testFromJson(string $payload): void
    {
        $json = json_decode($payload, false, 512, JSON_THROW_ON_ERROR);

        $price = PriceFactory::fromJson($json);

        self::assertPrice($json, $price);
    }

    public static function assertPrice(?stdClass $json, ?Price $price): void
    {
        if($json === null) {
            Assert::assertNull($price);
        } else {
            Assert::assertEquals($json->before_taxes, $price->getBeforeTaxes());
            Assert::assertCount(count($json->taxes ?? []), $price->getTaxes());
            foreach ($json->taxes ?? [] as $i => $jsonTax) {
                $tax = $price->getTaxes()[$i];
                Assert::assertSame($jsonTax->name, $tax->getName());
                Assert::assertEquals($jsonTax->account_number ?? null, $tax->getAccountNumber());
                Assert::assertEquals($jsonTax->percentage ?? null, $tax->getPercentage());
                Assert::assertEquals($jsonTax->amount, $tax->getAmount());
            }
        }
    }
}