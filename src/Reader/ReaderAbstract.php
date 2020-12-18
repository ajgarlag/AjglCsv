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

namespace Ajgl\Csv\Reader;

use Ajgl\Csv\Io\IoAbstract;
use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class ReaderAbstract extends IoAbstract implements ReaderInterface
{
    /**
     * @var array
     */
    protected $validModes = ['r', 'r+', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+'];

    public function __construct(string $filePath, string $delimiter = ReaderInterface::DELIMITER_DEFAULT, string $fileCharset = ReaderInterface::CHARSET_DEFAULT, string $mode = 'r')
    {
        parent::__construct($filePath, $mode, $delimiter, $fileCharset);
    }

    public function readNextRow(string $outputCharset = IoInterface::CHARSET_DEFAULT): ?array
    {
        $row = $this->doRead($this->getHandler(), $this->getDelimiter());

        if (null !== $row && $outputCharset !== $this->getFileCharset()) {
            $row = $this->convertRowCharset($row, $this->getFileCharset(), $outputCharset);
        }

        return $row;
    }

    public function readNextRows(string $inputCharset = IoInterface::CHARSET_DEFAULT, $limit = null): array
    {
        $res = [];
        if (null === $limit) {
            while ($row = $this->readNextRow($inputCharset)) {
                $res[] = $row;
            }
        } else {
            $limit = (int) $limit;
            for ($i = 0; $i < $limit; ++$i) {
                if ($row = $this->readNextRow($inputCharset)) {
                    $res[] = $row;
                } else {
                    break;
                }
            }
        }

        return $res;
    }

    abstract protected function doRead(): ?array;
}
