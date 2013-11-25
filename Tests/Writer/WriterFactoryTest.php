<?php

namespace Ajgl\Csv\Tests\Writer;

use Ajgl\Csv\Writer\WriterFactory;

class WriterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var WriterFactory
     */
    protected $writerFactory;

    protected function setUp()
    {
        $this->writerFactory = new WriterFactory();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported writer type 'foo'
     */
    public function testCreateWriterFailsOnUnsupportedWriter()
    {
        $this->createWriter('foo');
    }

    public function testCreateWriterCreatesCorrectWriterType()
    {
        $nativeWriter = $this->createWriter('php');
        $this->assertInstanceOf('\Ajgl\Csv\Writer\NativePhpWriter', $nativeWriter);

        $rfcWriter = $this->createWriter('rfc');
        $this->assertInstanceOf('\Ajgl\Csv\Writer\RfcWriter', $rfcWriter);
    }

    private function createWriter($type)
    {
        return $this->writerFactory->createWriter($type, tempnam(sys_get_temp_dir(), __NAMESPACE__.'\\'.__CLASS__), 'w');
    }
}
