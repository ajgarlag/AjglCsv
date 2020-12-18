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

namespace Ajgl\Csv\Tests\Writer;

use Ajgl\Csv\Writer\WriterFactory;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class WriterFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var WriterFactory
     */
    protected $writerFactory;

    protected function setUp(): void
    {
        $this->writerFactory = new WriterFactory();
    }

    public function testCreateWriterFailsOnUnsupportedWriter(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported writer type \'foo\'');

        $this->createWriter('foo');
    }

    public function testCreateWriterCreatesCorrectWriterType(): void
    {
        $nativeWriter = $this->createWriter('php');
        $this->assertInstanceOf('\Ajgl\Csv\Writer\NativePhpWriter', $nativeWriter);

        $rfcWriter = $this->createWriter('rfc');
        $this->assertInstanceOf('\Ajgl\Csv\Writer\RfcWriter', $rfcWriter);
    }

    private function createWriter($type)
    {
        return $this->writerFactory->createWriter($type, tempnam(sys_get_temp_dir(), __NAMESPACE__.'\\'.__CLASS__));
    }
}
