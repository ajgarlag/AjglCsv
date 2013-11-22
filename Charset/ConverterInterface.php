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
interface ConverterInterface
{
    /**
     * @param  string $value
     * @param  string $inputCharset
     * @param  string $outputCharset
     * @return string
     */
    public function convert($value, $inputCharset, $outputCharset);
}
