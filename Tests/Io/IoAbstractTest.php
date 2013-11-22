<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Io\Tests
 */
namespace Ajgl\Csv\Tests\Io;

use Ajgl\Csv\Io\IoAbstract;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Io\Tests
 */
class IoAbstractTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IoAbstract
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
            'filePath' => tempnam(sys_get_temp_dir(), 'test_'),
            'mode' => 'w+',
            'delimiter' => ';',
            'fileCharset' => 'ASCII'
        );
        $this->object = new IoAbstractImplementation(
            $this->params['filePath'],
            $this->params['delimiter'],
            $this->params['fileCharset']
        );
    }

    public function testGetFilePath()
    {
        $this->assertEquals($this->params['filePath'], $this->object->getFilePath());
    }

    public function testGetDelimeter()
    {
        $this->assertEquals($this->params['delimiter'], $this->object->getDelimiter());
    }

    public function testGetFileCharset()
    {
        $this->assertEquals($this->params['fileCharset'], $this->object->getFileCharset());
    }

    public function testGetConverter()
    {
        $this->assertInstanceOf('\Ajgl\Csv\Charset\ConverterInterface', $this->object->getConverter());
    }

    public function testSetConverter()
    {
        $converter = $this->getMock('\Ajgl\Csv\Charset\ConverterInterface');
        $this->assertSame($this->object, $this->object->setConverter($converter));
        $this->assertSame($converter, $this->object->getConverter());
    }

}

class IoAbstractImplementation
    extends IoAbstract
{
    public function __construct($filePath, $delimiter, $fileCharset)
    {
        $this->filePath = $filePath;
        $this->delimiter = $delimiter;
        $this->fileCharset = $fileCharset;
    }
}
