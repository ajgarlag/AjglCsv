<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
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
        if ($inputCharset != $outputCharset) {
            $value = mb_convert_encoding($value, $outputCharset, $inputCharset);
        }

        return $value;
    }
}
