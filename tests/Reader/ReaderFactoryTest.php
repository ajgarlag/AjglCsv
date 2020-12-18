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

namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\ReaderFactory;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class ReaderFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ReaderFactory
     */
    protected $readerFactory;

    protected function setUp(): void
    {
        $this->readerFactory = new ReaderFactory();
    }

    public function testCreateReaderFailsOnUnsupportedReader(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported reader type \'foo\'');

        $this->createReader('foo');
    }

    public function testCreateReaderCreatesCorrectReaderType(): void
    {
        $nativeReader = $this->createReader('php');
        $this->assertInstanceOf('\Ajgl\Csv\Reader\NativePhpReader', $nativeReader);

        $rfcReader = $this->createReader('rfc');
        $this->assertInstanceOf('\Ajgl\Csv\Reader\RfcReader', $rfcReader);
    }

    private function createReader($type)
    {
        return $this->readerFactory->createReader($type, tempnam(sys_get_temp_dir(), __NAMESPACE__.'\\'.__CLASS__));
    }
}
