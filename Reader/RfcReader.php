<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Reader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcReader
    extends ReaderAbstract
{
    const STATE_FIELD_START = "1";
    const STATE_BUFFERING_UNQUOTED_FIELD = "2";
    const STATE_BUFFERING_QUOTED_FIELD = "3";
    const STATE_QUOTE_IN_QUOTED_FIELD = "4";
    const STATE_EOL_START = "5";

    const CHAR_QUOTE = '"';
    const CHAR_CR = "\r";
    const CHAR_LF = "\n";

    private $acceptStates = array(self::STATE_FIELD_START, self::STATE_BUFFERING_UNQUOTED_FIELD);

    /**
     * @inheritdoc
     */
    protected function doRead($fileHandler, $delimiter)
    {
        if (feof($fileHandler)) {
            return;
        }

        $state = self::STATE_FIELD_START;
        $row = array();
        $field = "";

        while ($char = fgetc($fileHandler)) {
            switch ($state) {
                case self::STATE_FIELD_START:
                    switch ($char) {
                        case $delimiter:
                            $row[] = $field;
                            $field = "";
                            break;
                        case self::CHAR_QUOTE:
                            $state = self::STATE_BUFFERING_QUOTED_FIELD;
                            break;
                        case self::CHAR_CR:
                            $state = self::STATE_EOL_START;
                            break;
                        default:
                            $field .= $char;
                            $state = self::STATE_BUFFERING_UNQUOTED_FIELD;
                            break;
                    }
                    break;
                case self::STATE_BUFFERING_UNQUOTED_FIELD:
                    switch ($char) {
                        case $delimiter:
                            $row[] = $field;
                            $field = "";
                            $state = self::STATE_FIELD_START;
                            break;
                        case self::CHAR_CR:
                            $state = self::STATE_EOL_START;
                            break;
                        default:
                            $field .= $char;
                            break;
                    }
                    break;
                case self::STATE_BUFFERING_QUOTED_FIELD:
                    switch ($char) {
                        case self::CHAR_QUOTE:
                            $state = self::STATE_QUOTE_IN_QUOTED_FIELD;
                            break;
                        default:
                            $field .= $char;
                            break;
                    }
                    break;
                case self::STATE_QUOTE_IN_QUOTED_FIELD:
                    switch ($char) {
                        case $delimiter:
                            $row[] = $field;
                            $field = "";
                            $state = self::STATE_FIELD_START;
                            break;
                        default:
                            $field .= $char;
                            $state = self::STATE_BUFFERING_QUOTED_FIELD;
                            break;
                    }
                    break;
                case self::STATE_EOL_START:
                    switch ($char) {
                        case self::CHAR_LF:
                            $row[] = $field;
                            return $row;
                            break;
                        default:
                            throw new \RuntimeException("Expected LF char not found.");
                            break;
                    }
                    break;
            }
        }

        if (!in_array($state, $this->acceptStates)) {
            throw new \RuntimeException("Premature EOF.");
        }

        $row[] = $field;
        return $row;

    }

}
