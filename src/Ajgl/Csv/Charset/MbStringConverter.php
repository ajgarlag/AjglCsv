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
class MbStringConverter
    implements ConverterInterface
{
    /**
     * @inheritdoc
     */
    public function convert($value, $inputCharset, $outputCharset)
    {
        /**
         * @see http://www.php.net/manual/en/function.iconv.php#108643
         */
        if ($inputCharset != $outputCharset) {
            $char = ini_get('mbstring.substitute_character');
            ini_set('mbstring.substitute_character', 32);
            $value = mb_convert_encoding($value, $outputCharset, $inputCharset);
            ini_set('mbstring.substitute_character', $char);
        }

        return $value;
    }
}
