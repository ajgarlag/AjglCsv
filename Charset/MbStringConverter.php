<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Charset;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
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
