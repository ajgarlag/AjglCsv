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

namespace Ajgl\Csv\Io;

use Ajgl\Csv\Charset\ConverterInterface;
use Ajgl\Csv\Charset\MbStringConverter;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class IoAbstract implements IoInterface
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
    protected $validModes = [];

    public function __construct(
        string $filePath,
        string $mode,
        string $delimiter = IoInterface::DELIMITER_DEFAULT,
        string $fileCharset = IoInterface::CHARSET_DEFAULT
    ) {
        $this->filePath = $filePath;
        $this->fileCharset = $fileCharset;
        $this->delimiter = $delimiter;

        $this->setMode($mode);
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getFileCharset(): string
    {
        return $this->fileCharset;
    }

    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    public function getConverter(): ConverterInterface
    {
        if (null === $this->converter) {
            $this->setConverter(new MbStringConverter());
        }

        return $this->converter;
    }

    public function setConverter(ConverterInterface $converter): self
    {
        $this->converter = $converter;

        return $this;
    }

    public function close(): void
    {
        if (\is_resource($this->fileHandler)) {
            $res = @fclose($this->fileHandler);
            if (false === $res) {
                throw new \RuntimeException('Cannot close the given resource');
            }
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function setMode(string $mode): self
    {
        $mode = substr((string) $mode, 0, 2);
        if (!\in_array($mode, $this->validModes, true)) {
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
        if (!\is_resource($this->fileHandler)) {
            $this->fileHandler = $this->openHandler($this->filePath, $this->mode);
        }

        return $this->fileHandler;
    }

    /**
     * @throws \RuntimeException
     *
     * @return resource
     */
    protected function openHandler(string $filePath, string $mode)
    {
        $fileHandler = @fopen($filePath, $mode);
        if (false === $fileHandler) {
            throw new \RuntimeException("Cannot open the file '$filePath' in '$mode' mode");
        }

        return $fileHandler;
    }

    protected function convertRowCharset(array $row, string $inputCharset, string $fileCharset): array
    {
        foreach ($row as $k => $v) {
            if (\is_string($v)) {
                $row[$k] = $this->getConverter()->convert($v, $inputCharset, $fileCharset);
            }
        }

        return $row;
    }
}
