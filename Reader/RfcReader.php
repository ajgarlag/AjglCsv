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

    /**
     * @var array
     */
    private $acceptStates = array(
        self::STATE_FIELD_START,
        self::STATE_BUFFERING_UNQUOTED_FIELD,
        self::STATE_EOL_START
    );

    /**
     * @var boolean
     */
    private $strictRfcEolMode = false;

    /**
     * @inheritdoc
     */
    protected function doRead()
    {
        if (feof($this->getHandler())) {
            return;
        }

        $state = self::STATE_FIELD_START;
        $row = array();
        $field = "";

        while (false !== $char = fgetc($this->getHandler())) {
            switch ($state) {
                case self::STATE_FIELD_START:
                    $this->handleFieldStartState($char, $state, $field, $row);
                    break;
                case self::STATE_BUFFERING_UNQUOTED_FIELD:
                    $this->handleBufferingUnquotedFieldState($char, $state, $field, $row);
                    break;
                case self::STATE_BUFFERING_QUOTED_FIELD:
                    $this->handleBufferingQuotedFieldState($char, $state, $field, $row);
                    break;
                case self::STATE_QUOTE_IN_QUOTED_FIELD:
                    $this->handleQuoteInQuotedFieldState($char, $state, $field, $row);
                    break;
                case self::STATE_EOL_START:
                    $this->handleEolStartState($char, $state, $field, $row);
                    return $row;
                    break;
            }
        }

        if (!in_array($state, $this->acceptStates)) {
            throw new \RuntimeException("Premature EOF.");
        } else {
            $row[] = $field;
        }

        return $row;
    }

    /**
     * @param string $char
     * @param integer $state
     * @param string $field
     * @param array $row
     */
    private function handleFieldStartState($char, &$state, &$field, array &$row)
    {
        switch ($char) {
            case $this->getDelimiter():
                $row[] = $field;
                $field = "";
                break;
            case self::CHAR_QUOTE:
                $state = self::STATE_BUFFERING_QUOTED_FIELD;
                break;
            case self::CHAR_LF:
                if ($this->isStrictRfcEolModeSet()) {
                    throw new \RuntimeException("Unexpected EOL. Strict RFC EOL Mode set.");
                }
            case self::CHAR_CR:
                $state = self::STATE_EOL_START;
                break;
            default:
                $field .= $char;
                $state = self::STATE_BUFFERING_UNQUOTED_FIELD;
                break;
        }
    }

    /**
     * @param string $char
     * @param integer $state
     * @param string $field
     * @param array $row
     */
    private function handleBufferingUnquotedFieldState($char, &$state, &$field, array &$row)
    {
        switch ($char) {
            case $this->getDelimiter():
                $row[] = $field;
                $field = "";
                $state = self::STATE_FIELD_START;
                break;
            case self::CHAR_LF:
                if ($this->isStrictRfcEolModeSet()) {
                    throw new \RuntimeException("Unexpected EOL. Strict RFC EOL Mode set.");
                }
            case self::CHAR_CR:
                $state = self::STATE_EOL_START;
                break;
            default:
                $field .= $char;
                break;
        }
    }

    /**
     * @param string $char
     * @param integer $state
     * @param string $field
     * @param array $row
     */
    private function handleBufferingQuotedFieldState($char, &$state, &$field, array &$row)
    {
        switch ($char) {
            case self::CHAR_QUOTE:
                $state = self::STATE_QUOTE_IN_QUOTED_FIELD;
                break;
            default:
                $field .= $char;
                break;
        }
    }

    /**
     * @param string $char
     * @param integer $state
     * @param string $field
     * @param array $row
     */
    private function handleQuoteInQuotedFieldState($char, &$state, &$field, array &$row)
    {
        switch ($char) {
            case $this->getDelimiter():
                $row[] = $field;
                $field = "";
                $state = self::STATE_FIELD_START;
                break;
            case self::CHAR_LF:
                if ($this->isStrictRfcEolModeSet()) {
                    throw new \RuntimeException("Unexpected EOL. Strict RFC EOL Mode set.");
                }
            case self::CHAR_CR:
                $state = self::STATE_EOL_START;
                break;
            default:
                $field .= $char;
                $state = self::STATE_BUFFERING_QUOTED_FIELD;
                break;
        }
    }

    /**
     * @param string $char
     * @param integer $state
     * @param string $field
     * @param array $row
     */
    private function handleEolStartState($char, &$state, &$field, array &$row)
    {
        switch ($char) {
            default:
                fseek($this->getHandler(), ftell($this->getHandler()) -1);
            case self::CHAR_CR:
                if ($this->isStrictRfcEolModeSet()) {
                    throw new \RuntimeException("Unexpected EOL. Strict RFC EOL Mode set.");
                }
            case self::CHAR_LF:
                $row[] = $field;
                break;
        }
    }

    /**
     * @param boolean $flag
     */
    public function setStrictRfcEolMode($flag)
    {
        $this->strictRfcEolMode = (boolean) $flag;
    }

    /**
     * @return boolean
     */
    public function isStrictRfcEolModeSet()
    {
        return $this->strictRfcEolMode;
    }
}
