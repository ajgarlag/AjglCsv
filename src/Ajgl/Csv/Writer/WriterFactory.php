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
class WriterFactory
    implements WriterFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createWriter(
        $type,
        $filePath,
        $mode,
        $delimiter = WriterInterface::DELIMITER_DEFAULT,
        $fileCharset = WriterInterface::CHARSET_DEFAULT
    )
    {
        switch ($type) {
            case 'php':
                return new NativePhpWriter($filePath, $mode, $delimiter, $fileCharset);
                break;
            case 'rfc':
                return new RfcWriter($filePath, $mode, $delimiter, $fileCharset);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf("Unsupported writer type '%s'", $type)
                );
                break;
        }
    }
}
