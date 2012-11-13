<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Reader
 */
namespace Ajgl\Csv\Reader;

use Ajgl\Csv\Io\IoInterface;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Reader
 */
interface ReaderInterface
    extends IoInterface
{

    /**
     * @param  string $inputCharset
     * @return array
     */
    public function readNextRow($inputCharset = IoInterface::CHARSET_DEFAULT_INPUT);

    /**
     * @param  string  $inputCharset
     * @param  integer $limit
     * @return array
     */
    public function readNextRows($inputCharset = IoInterface::CHARSET_DEFAULT_INPUT, $limit = null);

}
