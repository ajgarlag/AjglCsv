<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Reader
 */
namespace Ajgl\Csv\Reader;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Reader
 */
interface ReaderFactoryInterface
{
    /**
     * @param  string          $type
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @return ReaderInterface
     */
    public function createReader(
        $type,
        $filePath,
        $mode,
        $delimiter = ReaderInterface::DELIMITER_DEFAULT,
        $fileCharset = ReaderInterface::CHARSET_DEFAULT
    );
}
