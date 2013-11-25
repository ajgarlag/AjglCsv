<?php

namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\ReaderFactory;

class ReaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReaderFactory
     */
    protected $readerFactory;

    protected function setUp()
    {
        $this->readerFactory = new ReaderFactory();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported reader type 'foo'
     */
    public function testCreateReaderFailsOnUnsupportedReader()
    {
        $this->createReader('foo');
    }

    public function testCreateReaderCreatesCorrectReaderType()
    {
        $nativeReader = $this->createReader('php');
        $this->assertInstanceOf('\Ajgl\Csv\Reader\NativePhpReader', $nativeReader);

        $rfcReader = $this->createReader('rfc');
        $this->assertInstanceOf('\Ajgl\Csv\Reader\RfcReader', $rfcReader);
    }

    private function createReader($type)
    {
        return $this->readerFactory->createReader($type, tempnam(sys_get_temp_dir(), __NAMESPACE__.'\\'.__CLASS__), 'r');
    }
}
