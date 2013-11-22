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
class NativePhpReader
    extends ReaderAbstract
{
    /**
     * @inheritdoc
     */
    protected function doRead($fileHandler, $delimiter)
    {
        $row = fgetcsv($fileHandler, 0, $delimiter);

        return ($row !== false)?$row:null;
    }
}
