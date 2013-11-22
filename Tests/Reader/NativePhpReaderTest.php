<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Reader\Tests
 */
namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\NativePhpReader;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Reader\Tests
 */
class NativePhpReaderTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NativePhpReader
     */
    protected $object;

    /**
     * @var array
     */
    protected $params = array();

    protected function setUp()
    {
        parent::setUp();

        $this->params = array(
            'filePath' => __DIR__ . '/_files/php_test.csv',
            'mode' => 'r',
            'delimiter' => ',',
            'fileCharset' => 'ASCII'
        );
        $this->object = new NativePhpReader(
            $this->params['filePath'],
            $this->params['mode'],
            $this->params['delimiter'],
            $this->params['fileCharset']
        );
    }

    public function testReadNextRow()
    {
        $expected = array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo');
        $actual = $this->object->readNextRow();
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRows()
    {
        $expected = array(
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo'),
            array('fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber','"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber','fuu'."\r\n".'"ber"','fuu,'."\r\n".'Ber','fuu'."\r\n".'Ber,ber', 'fuu'),
            array(''),
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo')
        );
        $actual = $this->object->readNextRows();
        $this->assertEquals($expected, $actual);
    }
}
