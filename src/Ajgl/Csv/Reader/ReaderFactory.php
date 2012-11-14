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
class ReaderFactory
    implements ReaderFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createReader(
        $type,
        $filePath,
        $mode,
        $delimiter = ReaderInterface::DELIMITER_DEFAULT,
        $fileCharset = ReaderInterface::CHARSET_DEFAULT
    )
    {
        switch ($type) {
            case 'php':
                return new NativePhpReader($filePath, $mode, $delimiter, $fileCharset);
                break;
            case 'rfc':
                return new RfcReader($filePath, $mode, $delimiter, $fileCharset);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf("Unsupported reader type '%s'", $type)
                );
                break;
        }
    }
}
