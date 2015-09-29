<?php

/*
 * This file is part of the AJGL packages
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Tests\Charset;

use Ajgl\Csv\Charset\IconvConverter;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class IconvConverterTest
    extends ConverterTestAbstract
{
    protected function setUp()
    {
        parent::setUp();

        $this->object = new IconvConverter();
    }

    /**
     * @dataProvider getPangrams
     */
    public function testConvert($outputCharset, $pangram)
    {
        $expected = iconv('UTF-8', $outputCharset, $pangram);
        $actual = $this->object->convert($pangram, 'UTF-8', $outputCharset);
        $this->assertEquals($expected, $actual);
    }
}
