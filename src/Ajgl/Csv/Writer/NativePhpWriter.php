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
class NativePhpWriter
    extends WriterAbstract
{
    /**
     * @inheritdoc
     */
    protected function doWrite($fileHandler, array $row, $delimiter)
    {
        $res = @fputcsv($fileHandler, $row, $delimiter);
        if (false === $res) {
            throw new \RuntimeException("Cannot write to the given resource");
        }
    }
}
