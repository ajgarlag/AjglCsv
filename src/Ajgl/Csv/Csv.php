<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 */
namespace Ajgl\Csv;

use Ajgl\Csv\Reader\ReaderFactoryInterface;
use Ajgl\Csv\Writer\WriterFactoryInterface;
use Ajgl\Csv\Reader\ReaderInterface;
use Ajgl\Csv\Writer\WriterInterface;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
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
     * @return ReaderFactoryInterface
     */
    public function getReaderFactory()
    {
        return $this->readerFactory;
    }

    /**
     * @param  \Ajgl\Csv\Reader\ReaderFactoryInterface $readerFactory
     * @return \Ajgl\Csv\Csv
     */
    public function setReaderFactory(ReaderFactoryInterface $readerFactory)
    {
        $this->readerFactory = $readerFactory;

        return $this;
    }

    /**
     * @return WriterFactoryInterface
     */
    public function getWriterFactory()
    {
        return $this->writerFactory;
    }

    /**
     * @param  \Ajgl\Csv\Writer\WriterFactoryInterface $writerFactory
     * @return \Ajgl\Csv\Csv
     */
    public function setWriterFactory(WriterFactoryInterface $writerFactory)
    {
        $this->writerFactory = $writerFactory;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultReaderType()
    {
        return $this->defaultReaderType;
    }

    /**
     * @param  string        $defaultReaderType
     * @return \Ajgl\Csv\Csv
     */
    public function setDefaultReaderType($defaultReaderType)
    {
        $this->defaultReaderType = $defaultReaderType;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultWriterType()
    {
        return $this->defaultWriterType;
    }

    /**
     * @param  string        $defaultWriterType
     * @return \Ajgl\Csv\Csv
     */
    public function setDefaultWriterType($defaultWriterType)
    {
        $this->defaultWriterType = $defaultWriterType;

        return $this;
    }

    /**
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @param  string          $type
     * @return ReaderInterface
     */
    public function getReader($filePath, $mode, $delimiter = ReaderInterface::DELIMITER_DEFAULT, $fileCharset = ReaderInterface::CHARSET_DEFAULT_OUTPUT, $type = null)
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
    public function getWriter($filePath, $mode, $delimiter = WriterInterface::DELIMITER_DEFAULT, $fileCharset = WriterInterface::CHARSET_DEFAULT_OUTPUT, $type = null)
    {
        if (null === $type) {
            $type = $this->getDefaultWriterType();
        }

        return $this->getWriterFactory()->createWriter($type, $filePath, $mode, $delimiter, $fileCharset);
    }
}
