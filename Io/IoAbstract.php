<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Io;

use Ajgl\Csv\Charset\ConverterInterface;
use Ajgl\Csv\Charset\MbStringConverter;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class IoAbstract
    implements IoInterface
{

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var string
     */
    protected $fileCharset;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var resource
     */
    protected $fileHandler;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @var array
     */
    protected $validModes = array();

    /**
     * Class constructor
     * @param string $filePath
     * @param string $mode
     * @param string $delimiter
     * @param string $fileCharset
     */
    public function __construct(
        $filePath,
        $mode,
        $delimiter = WriterInterface::DELIMITER_DEFAULT,
        $fileCharset = WriterInterface::CHARSET_DEFAULT
    )
    {
        $this->filePath = $filePath;
        $this->fileCharset = $fileCharset;
        $this->delimiter = $delimiter;

        $this->setMode($mode);
    }

    /**
     * @inheritdoc
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @inheritdoc
     */
    public function getFileCharset()
    {
        return $this->fileCharset;
    }

    /**
     * @inheritdoc
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @inheritdoc
     */
    public function getConverter()
    {
        if (null === $this->converter) {
            $this->setConverter(new MbStringConverter());
        }

        return $this->converter;
    }

    /**
     * @param  \Ajgl\Csv\Charset\ConverterInterface $converter
     * @return \Ajgl\Csv\Io\IoAbstract
     */
    public function setConverter(ConverterInterface $converter)
    {
        $this->converter = $converter;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function close()
    {
        if (is_resource($this->fileHandler)) {
            $res = @fclose($this->fileHandler);
            if (false === $res) {
                throw new \RuntimeException("Cannot close the given resource");
            }
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @param  string                    $mode
     * @return \Ajgl\Csv\Io\IoAbstract
     * @throws \InvalidArgumentException
     */
    protected function setMode($mode)
    {
        $mode = substr((string) $mode, 0, 2);
        if (!in_array($mode, $this->validModes)) {
            throw new \InvalidArgumentException("The given mode '$mode' is not valid for the requested operation");
        }
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return resource
     */
    protected function getHandler()
    {
        if (!is_resource($this->fileHandler)) {
            $this->fileHandler = $this->openHandler($this->filePath, $this->mode);
        }

        return $this->fileHandler;
    }

    /**
     *
     * @param  string            $filePath
     * @param  string            $mode
     * @return resource
     * @throws \RuntimeException
     */
    protected function openHandler($filePath, $mode)
    {
        $fileHandler = @fopen($filePath, $mode);
        if (false === $fileHandler) {
            throw new \RuntimeException("Cannot open the file '$filePath' in '$mode' mode");
        }

        return $fileHandler;
    }

    /**
     * @param  array  $row
     * @param  string $inputCharset
     * @param  string $fileCharset
     * @return array
     */
    protected function convertRowCharset(array $row, $inputCharset, $fileCharset)
    {
        foreach ($row as $k => $v) {
            $row[$k] = $this->getConverter()->convert($v, $inputCharset, $fileCharset);
        }

        return $row;
    }
}
