<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv;

use Ajgl\Csv\Reader\ReaderFactoryInterface;
use Ajgl\Csv\Writer\WriterFactoryInterface;
use Ajgl\Csv\Reader\ReaderInterface;
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

    /**
     * @param \Ajgl\Csv\Reader\ReaderFactoryInterface $readerFactory
     * @param \Ajgl\Csv\Writer\WriterFactoryInterface $writerFactory
     */
    public function __construct(ReaderFactoryInterface $readerFactory, WriterFactoryInterface $writerFactory)
    {
        $this->setReaderFactory($readerFactory);
        $this->setWriterFactory($writerFactory);
    }

    /**
     * @return Csv
     */
    public static function create()
    {
        return new self(
            new Reader\ReaderFactory(),
            new Writer\WriterFactory()
        );
    }

    /**
     * @return ReaderFactoryInterface
     */
    public function getReaderFactory()
    {
        return $this->readerFactory;
    }

    /**
     * @param \Ajgl\Csv\Reader\ReaderFactoryInterface $readerFactory
     */
    public function setReaderFactory(ReaderFactoryInterface $readerFactory)
    {
        $this->readerFactory = $readerFactory;
    }

    /**
     * @return WriterFactoryInterface
     */
    public function getWriterFactory()
    {
        return $this->writerFactory;
    }

    /**
     * @param \Ajgl\Csv\Writer\WriterFactoryInterface $writerFactory
     */
    public function setWriterFactory(WriterFactoryInterface $writerFactory)
    {
        $this->writerFactory = $writerFactory;
    }

    /**
     * @return string
     */
    public function getDefaultReaderType()
    {
        return $this->defaultReaderType;
    }

    /**
     * @param string $defaultReaderType
     */
    public function setDefaultReaderType($defaultReaderType)
    {
        $this->defaultReaderType = $defaultReaderType;
    }

    /**
     * @return string
     */
    public function getDefaultWriterType()
    {
        return $this->defaultWriterType;
    }

    /**
     * @param string $defaultWriterType
     */
    public function setDefaultWriterType($defaultWriterType)
    {
        $this->defaultWriterType = $defaultWriterType;
    }

    /**
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @param  string          $type
     * @return ReaderInterface
     */
    public function createReader($filePath, $mode = 'r', $delimiter = ReaderInterface::DELIMITER_DEFAULT, $fileCharset = ReaderInterface::CHARSET_DEFAULT, $type = null)
    {
        if (null === $type) {
            $type = $this->getDefaultReaderType();
        }

        return $this->getReaderFactory()->createReader($type, $filePath, $mode, $delimiter, $fileCharset);
    }

    /**
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @param  string          $type
     * @return WriterInterface
     */
    public function createWriter($filePath, $mode = 'w', $delimiter = WriterInterface::DELIMITER_DEFAULT, $fileCharset = WriterInterface::CHARSET_DEFAULT, $type = null)
    {
        if (null === $type) {
            $type = $this->getDefaultWriterType();
        }

        return $this->getWriterFactory()->createWriter($type, $filePath, $mode, $delimiter, $fileCharset);
    }
}
