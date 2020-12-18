<?php

declare(strict_types=1);

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Tests\Charset;

use Ajgl\Csv\Charset\MbStringConverter;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class MbStringConverterTest extends ConverterTestAbstract
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->object = new MbStringConverter();
    }

    /**
     * @dataProvider getPangrams
     */
    public function testConvert($outputCharset, $pangram): void
    {
        $expected = mb_convert_encoding($pangram, $outputCharset, 'UTF-8');
        $actual = $this->object->convert($pangram, 'UTF-8', $outputCharset);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider getPangrams
     */
    public function testDoNoReportNoticeOnIllegalCharacter($outputCharset, $pangram): void
    {
        $pangrams = static::getPangrams();
        $converted = $this->object->convert($pangram, 'UTF-8', 'ISO-8859-1');
        $this->assertNotEquals($pangrams, $converted);
    }
}
