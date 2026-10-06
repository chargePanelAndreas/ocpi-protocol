<?php

declare(strict_types=1);

namespace Tests\Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TokenType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chargemap\OCPI\Common\Models\OpenEnum
 */
class OpenEnumTest extends TestCase
{
    public function testOpenEnumKeepsUnknownValues(): void
    {
        $type = new TokenType('SOMETHING_NEW');
        $this->assertSame('SOMETHING_NEW', $type->getValue());
        $this->assertFalse($type->isKnown());
        $this->assertSame('"SOMETHING_NEW"', json_encode($type));
        $this->assertTrue((new TokenType('EMAID'))->isKnown());
        $this->assertTrue(TokenType::EMAID()->equals(new TokenType('EMAID')));
        $this->assertSame('SOMETHING_NEW', TokenType::from('SOMETHING_NEW')->getValue());
    }
}
