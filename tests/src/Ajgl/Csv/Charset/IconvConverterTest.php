<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset\Tests
 */
namespace Ajgl\Csv\Charset;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset\Tests
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
