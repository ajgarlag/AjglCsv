<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
namespace Ajgl\Csv\Writer;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
interface WriterFactoryInterface
{
    /**
     * @param  string          $type
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @return WriterInterface
     */
    public function createWriter(
        $type,
        $filePath,
        $mode,
        $delimiter = WriterInterface::DELIMITER_DEFAULT,
        $fileCharset = WriterInterface::CHARSET_DEFAULT
    );
}
