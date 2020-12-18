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

namespace Ajgl\Csv;

use Ajgl\Csv\Reader\ReaderFactoryInterface;
use Ajgl\Csv\Reader\ReaderInterface;
use Ajgl\Csv\Writer\WriterFactoryInterface;
use Ajgl\Csv\Writer\WriterInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class Csv
{
    /**
     * @var string
     */
    protected $defaultReaderType = 'php';

    /**
     * @var ReaderFactoryInterface
     */
    protected $readerFactory;

    /**
     * @var string
     */
    protected $defaultWriterType = 'php';

    /**
     * @var WriterFactoryInterface
     */
    protected $writerFactory;

    public function __construct(ReaderFactoryInterface $readerFactory, WriterFactoryInterface $writerFactory)
    {
        $this->setReaderFactory($readerFactory);
        $this->setWriterFactory($writerFactory);
    }

    public static function create(): self
    {
        return new self(
            new Reader\ReaderFactory(),
            new Writer\WriterFactory()
        );
    }

    public function getReaderFactory(): ReaderFactoryInterface
    {
        return $this->readerFactory;
    }

    public function setReaderFactory(ReaderFactoryInterface $readerFactory): void
    {
        $this->readerFactory = $readerFactory;
    }

    public function getWriterFactory(): WriterFactoryInterface
    {
        return $this->writerFactory;
    }

    public function setWriterFactory(WriterFactoryInterface $writerFactory): void
    {
        $this->writerFactory = $writerFactory;
    }

    public function getDefaultReaderType(): string
    {
        return $this->defaultReaderType;
    }

    public function setDefaultReaderType(string $defaultReaderType): void
    {
        $this->defaultReaderType = $defaultReaderType;
    }

    public function getDefaultWriterType(): string
    {
        return $this->defaultWriterType;
    }

    public function setDefaultWriterType(string $defaultWriterType): void
    {
        $this->defaultWriterType = $defaultWriterType;
    }

    public function createReader(string $filePath, string $delimiter = ReaderInterface::DELIMITER_DEFAULT, string $fileCharset = ReaderInterface::CHARSET_DEFAULT, string $mode = 'r', string $type = null): ReaderInterface
    {
        if (null === $type) {
            $type = $this->getDefaultReaderType();
        }

        return $this->getReaderFactory()->createReader($type, $filePath, $delimiter, $fileCharset, $mode);
    }

    public function createWriter(string $filePath, string $delimiter = WriterInterface::DELIMITER_DEFAULT, string $fileCharset = WriterInterface::CHARSET_DEFAULT, string $mode = 'w', string $type = null): WriterInterface
    {
        if (null === $type) {
            $type = $this->getDefaultWriterType();
        }

        return $this->getWriterFactory()->createWriter($type, $filePath, $delimiter, $fileCharset, $mode);
    }
}
