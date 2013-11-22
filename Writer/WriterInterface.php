<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
namespace Ajgl\Csv\Writer;

use Ajgl\Csv\Io\IoInterface;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
interface WriterInterface
    extends IoInterface
{

    /**
     * @param array $row
     * @param type  $inputCharset
     */
    public function writeRow(array $row, $inputCharset = IoInterface::CHARSET_DEFAULT);

    /**
     * @param array $row
     * @param type  $inputCharset
     */
    public function writeRows(array $rows, $inputCharset = IoInterface::CHARSET_DEFAULT);
}
