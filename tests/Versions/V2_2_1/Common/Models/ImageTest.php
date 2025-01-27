<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_2_1\Common\Models;

use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Image;
use PHPUnit\Framework\Assert;
use stdClass;

/**
 * @covers \Chargemap\OCPI\Versions\V2_2_1\Common\Models\Image
 */
class ImageTest
{
    public static function assertJsonSerialization(?Image $image, ?stdClass $json): void
    {
        if ($image === null) {
            Assert::assertNull($json);
        } else {
            Assert::assertSame($image->getUrl(), $json->url);
            Assert::assertSame($image->getThumbnail(), $json->thumbnail);
            Assert::assertSame($image->getCategory()->getValue(), $json->category);
            Assert::assertSame($image->getType(), $json->type);
            Assert::assertSame($image->getWidth(), $json->width);
            Assert::assertSame($image->getHeight(), $json->height);
        }
    }
}
