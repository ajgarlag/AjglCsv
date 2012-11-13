<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Io
 */
namespace Ajgl\Csv\Io;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Io
 */
interface IoInterface
{
    /**
     * @var string
     */
    const CHARSET_DEFAULT = 'UTF-8';

    /**
     * @var string
     */
    const DELIMITER_DEFAULT = ',';

    /**
     * @return string
     */
    public function getFilePath();

    /**
     * @return string
     */
    public function getDelimiter();

    /**
     * @return string
     */
    public function getFileCharset();

    /**
     * @return \Ajgl\Csv\Charset\ConverterInterface
     */
    public function getConverter();

}
