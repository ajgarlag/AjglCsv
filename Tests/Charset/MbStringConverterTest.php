<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset\Tests
 */
namespace Ajgl\Csv\Tests\Charset;

use Ajgl\Csv\Charset\MbStringConverter;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset\Tests
 */
class MbStringConverterTest
    extends ConverterTestAbstract
{
    protected function setUp()
    {
        parent::setUp();

        $this->object = new MbStringConverter();
    }

    /**
     * @dataProvider getPangrams
     */
    public function testConvert($outputCharset, $pangram)
    {
        $expected = mb_convert_encoding($pangram, $outputCharset, 'UTF-8');
        $actual = $this->object->convert($pangram, 'UTF-8', $outputCharset);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider getPangrams
     */
    public function testDoNoReportNoticeOnIllegalCharacter($outputCharset, $pangram)
    {
        $pangrams = static::getPangrams();
        $this->object->convert($pangram, 'UTF-8', 'ISO-8859-1');
    }
}
