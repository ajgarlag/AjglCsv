<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset
 */
namespace Ajgl\Csv\Charset;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset
 */
class IconvConverter
    implements ConverterInterface
{
    /**
     * @inheritdoc
     */
    public function convert($value, $inputCharset, $outputCharset)
    {
        if ($inputCharset != $outputCharset) {
            $value = iconv($inputCharset, $outputCharset, $value);
        }

        return $value;
    }
}
