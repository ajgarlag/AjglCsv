<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Tests\Io;

use Ajgl\Csv\Io\IoAbstract;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
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
