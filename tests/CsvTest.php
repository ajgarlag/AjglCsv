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

namespace Ajgl\Csv\Tests;

use Ajgl\Csv\Csv;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class CsvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Csv
     */
    protected $csv;

    /**
     * @var \Ajgl\Csv\Reader\ReaderFactoryInterface
     */
    protected $readerFactory;

    /**
     * @var \Ajgl\Csv\Writer\WriterFactoryInterface
     */
    protected $writerFactory;

    protected function setUp(): void
    {
        $this->readerFactory = $this->getMock('\Ajgl\Csv\Reader\ReaderFactoryInterface');
        $this->writerFactory = $this->getMock('\Ajgl\Csv\Writer\WriterFactoryInterface');
        $this->csv = new Csv($this->readerFactory, $this->writerFactory);
    }

    public function testDefaultReaderType(): void
    {
        $this->assertSame('php', $this->csv->getDefaultReaderType());
    }

    public function testSetDefaultReaderType(): void
    {
        $this->assertNull($this->csv->setDefaultReaderType('foo'));
        $this->assertSame('foo', $this->csv->getDefaultReaderType());
    }

    public function testDefaultWriterType(): void
    {
        $this->assertSame('php', $this->csv->getDefaultWriterType());
    }

    public function testSetDefaultWriterType(): void
    {
        $this->assertNull($this->csv->setDefaultWriterType('foo'));
        $this->assertSame('foo', $this->csv->getDefaultWriterType());
    }

    public function testGetReaderFactory(): void
    {
        $this->assertSame($this->readerFactory, $this->csv->getReaderFactory());
    }

    public function testSetReaderFactory(): void
    {
        $readerFactory = $this->getMock('\Ajgl\Csv\Reader\ReaderFactoryInterface');
        $this->assertNull($this->csv->setReaderFactory($readerFactory));
        $this->assertSame($readerFactory, $this->csv->getReaderFactory());
    }

    public function testGetWriterFactory(): void
    {
        $this->assertSame($this->writerFactory, $this->csv->getWriterFactory());
    }

    public function testSetWriterFactory(): void
    {
        $writerFactory = $this->getMock('\Ajgl\Csv\Writer\WriterFactoryInterface');
        $this->assertNull($this->csv->setWriterFactory($writerFactory));
        $this->assertSame($writerFactory, $this->csv->getWriterFactory());
    }

    public function testCreateReader(): void
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
            ->willReturn($this->getMock('\Ajgl\Csv\Reader\ReaderInterface'))
        ;

        $this->csv->createReader($path);
    }

    public function testCreateWriter(): void
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
            ->willReturn($this->getMock('\Ajgl\Csv\Writer\WriterInterface'))
        ;

        $this->csv->createWriter($path);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf('Ajgl\Csv\Csv', Csv::create());
    }
}
