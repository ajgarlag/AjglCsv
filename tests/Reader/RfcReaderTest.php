<?php

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\RfcReader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RfcReader
     */
    protected $object;

    /**
     * @var array
     */
    protected $params = [];

    protected function setUp()
    {
        parent::setUp();

        $this->params = [
            'filePath' => __DIR__.'/_files/rfc_test.csv',
            'delimiter' => ',',
            'fileCharset' => 'ASCII',
            'mode' => 'r',
        ];
        $this->object = new RfcReader(
            $this->params['filePath'],
            $this->params['delimiter'],
            $this->params['fileCharset'],
            $this->params['mode']
        );
    }

    public function testReadNextRow()
    {
        $expected = ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'];
        $actual = $this->object->readNextRow();
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRowsWithLimitLesserThanRows()
    {
        $expected = [
            ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'],
            ['fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber', '"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber', 'fuu'."\r\n".'"ber"', 'fuu,'."\r\n".'Ber', 'fuu'."\r\n".'Ber,ber', 'fuu'],
        ];
        $actual = $this->object->readNextRows(RfcReader::CHARSET_DEFAULT, 2);
        $this->assertEquals($expected, $actual);

        $expected = [
            [''],
            ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'],
        ];
        $actual = $this->object->readNextRows();
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRowsWithLimitGreaterThanRows()
    {
        $expected = [
            ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'],
            ['fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber', '"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber', 'fuu'."\r\n".'"ber"', 'fuu,'."\r\n".'Ber', 'fuu'."\r\n".'Ber,ber', 'fuu'],
            [''],
            ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'],
        ];
        $actual = $this->object->readNextRows(RfcReader::CHARSET_DEFAULT, 6);
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRowsWithoutLimit()
    {
        $expected = [
            ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'],
            ['fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber', '"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber', 'fuu'."\r\n".'"ber"', 'fuu,'."\r\n".'Ber', 'fuu'."\r\n".'Ber,ber', 'fuu'],
            [''],
            ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'],
        ];
        $actual = $this->object->readNextRows();
        $this->assertEquals($expected, $actual);
    }

    public function testReadingUnixFile()
    {
        $object = new RfcReader(
            __DIR__.'/_files/rfc_test_lf.csv',
            $this->params['delimiter'],
            $this->params['fileCharset'],
            $this->params['mode']
        );
        $this->assertCount(3, $object->readNextRows());
    }

    public function testReadingMacFile()
    {
        ini_set('auto_detect_line_endings', 1);
        $object = new RfcReader(
            __DIR__.'/_files/rfc_test_cr.csv',
            $this->params['delimiter'],
            $this->params['fileCharset'],
            $this->params['mode']
        );
        $this->assertCount(3, $object->readNextRows());
    }
}
