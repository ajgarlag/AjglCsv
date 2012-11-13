<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
namespace Ajgl\Csv\Writer;

use Ajgl\Csv\Io\IoAbstract;
use Ajgl\Csv\Io\IoInterface;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
abstract class WriterAbstract
    extends IoAbstract
    implements WriterInterface
{
    /**
     * @var array
     */
    protected $validModes = array('r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+');

    /**
     * @inheritdoc
     */
    public function writeRow(array $row, $inputCharset = IoInterface::CHARSET_DEFAULT)
    {
        if ($inputCharset != $this->getFileCharset()) {
            $row = $this->convertRowCharset($row, $inputCharset, $this->getFileCharset());
        }
        $this->doWrite($this->getHandler(), $row, $this->getDelimiter());

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function writeRows(array $rows, $inputCharset = IoInterface::CHARSET_DEFAULT)
    {
        foreach ($rows as $row) {
            $this->writeRow($row, $inputCharset);
        }

        return $this;
    }

    /**
     * @param resource $fileHandler
     * @param array    $row
     * @param string   $delimiter
     */
    abstract protected function doWrite($fileHandler, array $row, $delimiter);
}
