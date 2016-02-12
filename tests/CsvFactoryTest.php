<?php

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Tests;

use Ajgl\Csv\CsvFactory;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class CsvFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CsvFactory
     */
    protected $csvFactory;

    /**
     * @var \Ajgl\Csv\Reader\ReaderFactoryInterface
     */
    protected $readerFactory;

    /**
     * @var \Ajgl\Csv\Writer\WriterFactoryInterface
     */
    protected $writerFactory;

    protected function setUp()
    {
        $this->readerFactory = $this->getMock('\Ajgl\Csv\Reader\ReaderFactoryInterface');
        $this->writerFactory = $this->getMock('\Ajgl\Csv\Writer\WriterFactoryInterface');
        $this->csvFactory = new CsvFactory($this->readerFactory, $this->writerFactory);
    }

    public function testDefaultReaderType()
    {
        $this->assertSame('php', $this->csvFactory->getDefaultReaderType());
    }

    public function testSetDefaultReaderType()
    {
        $this->assertNull($this->csvFactory->setDefaultReaderType('foo'));
        $this->assertSame('foo', $this->csvFactory->getDefaultReaderType());
    }

    public function testDefaultWriterType()
    {
        $this->assertSame('php', $this->csvFactory->getDefaultWriterType());
    }

    public function testSetDefaultWriterType()
    {
        $this->assertNull($this->csvFactory->setDefaultWriterType('foo'));
        $this->assertSame('foo', $this->csvFactory->getDefaultWriterType());
    }

    public function testGetReaderFactory()
    {
        $this->assertSame($this->readerFactory, $this->csvFactory->getReaderFactory());
    }

    public function testSetReaderFactory()
    {
        $readerFactory = $this->getMock('\Ajgl\Csv\Reader\ReaderFactoryInterface');
        $this->assertNull($this->csvFactory->setReaderFactory($readerFactory));
        $this->assertSame($readerFactory, $this->csvFactory->getReaderFactory());
    }

    public function testGetWriterFactory()
    {
        $this->assertSame($this->writerFactory, $this->csvFactory->getWriterFactory());
    }

    public function testSetWriterFactory()
    {
        $writerFactory = $this->getMock('\Ajgl\Csv\Writer\WriterFactoryInterface');
        $this->assertNull($this->csvFactory->setWriterFactory($writerFactory));
        $this->assertSame($writerFactory, $this->csvFactory->getWriterFactory());
    }

    public function testCreateReader()
    {
        $path = tempnam(sys_get_temp_dir(), __NAMESPACE__.'\\'.__CLASS__);
        $this->readerFactory
            ->expects($this->once())
            ->method('createReader')
            ->with(
                $this->equalTo('php'),
                $this->equalTo($path),
                $this->equalTo(\Ajgl\Csv\Io\IoInterface::DELIMITER_DEFAULT),
                $this->equalTo(\Ajgl\Csv\Io\IoInterface::CHARSET_DEFAULT),
                $this->equalTo('r')
            )
        ;

        $this->csvFactory->createReader($path);
    }

    public function testCreateWriter()
    {
        $path = tempnam(sys_get_temp_dir(), __NAMESPACE__.'\\'.__CLASS__);
        $this->writerFactory
            ->expects($this->once())
            ->method('createWriter')
            ->with(
                $this->equalTo('php'),
                $this->equalTo($path),
                $this->equalTo(\Ajgl\Csv\Io\IoInterface::DELIMITER_DEFAULT),
                $this->equalTo(\Ajgl\Csv\Io\IoInterface::CHARSET_DEFAULT),
                $this->equalTo('w')
            )
        ;

        $this->csvFactory->createWriter($path);
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Ajgl\Csv\CsvFactory', CsvFactory::create());
    }
}
