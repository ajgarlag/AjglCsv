<?php

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

    /**
     * Class constructor.
     *
     * @param string $filePath
     * @param string $delimiter
     * @param string $fileCharset
     * @param string $mode
     */
    public function __construct($filePath, $delimiter = ReaderInterface::DELIMITER_DEFAULT, $fileCharset = ReaderInterface::CHARSET_DEFAULT, $mode = 'r')
    {
        parent::__construct($filePath, $mode, $delimiter, $fileCharset);
    }

    /**
     * {@inheritdoc}
     */
    public function readNextRow($outputCharset = IoInterface::CHARSET_DEFAULT)
    {
        $row = $this->doRead($this->getHandler(), $this->getDelimiter());

        if (null !== $row && $outputCharset !== $this->getFileCharset()) {
            $row = $this->convertRowCharset($row, $this->getFileCharset(), $outputCharset);
        }

        return $row;
    }

    /**
     * {@inheritdoc}
     */
    public function readNextRows($inputCharset = IoInterface::CHARSET_DEFAULT, $limit = null)
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

    /**
     * @return array
     */
    abstract protected function doRead();
}
