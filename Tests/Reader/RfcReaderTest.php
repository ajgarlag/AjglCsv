<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\RfcReader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcReaderTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RfcReader
     */
    protected $object;

    /**
     * @var array
     */
    protected $params = array();

    protected function setUp()
    {
        parent::setUp();

        $this->params = array(
            'filePath' => __DIR__ . '/_files/rfc_test.csv',
            'delimiter' => ',',
            'fileCharset' => 'ASCII',
            'mode' => 'r'
        );
        $this->object = new RfcReader(
            $this->params['filePath'],
            $this->params['delimiter'],
            $this->params['fileCharset'],
            $this->params['mode']
        );
    }

    public function testReadNextRow()
    {
        $expected = array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo');
        $actual = $this->object->readNextRow();
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRowsWithLimitLesserThanRows()
    {
        $expected = array(
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo'),
            array('fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber','"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber','fuu'."\r\n".'"ber"','fuu,'."\r\n".'Ber','fuu'."\r\n".'Ber,ber', 'fuu')
        );
        $actual = $this->object->readNextRows(RfcReader::CHARSET_DEFAULT, 2);
        $this->assertEquals($expected, $actual);

        $expected = array(
            array(""),
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo')
        );
        $actual = $this->object->readNextRows();
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRowsWithLimitGreaterThanRows()
    {
        $expected = array(
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo'),
            array('fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber','"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber','fuu'."\r\n".'"ber"','fuu,'."\r\n".'Ber','fuu'."\r\n".'Ber,ber', 'fuu'),
            array(""),
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo')
        );
        $actual = $this->object->readNextRows(RfcReader::CHARSET_DEFAULT, 6);
        $this->assertEquals($expected, $actual);

    }

    public function testReadNextRowsWithoutLimit()
    {
        $expected = array(
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo'),
            array('fuu', 'ber', '', 'fuu "ber"', 'fuu ber', 'fuu, ber','"fuu" ber', '\"fuu\" ber', '"fuu"'."\r\n".'Ber','fuu'."\r\n".'"ber"','fuu,'."\r\n".'Ber','fuu'."\r\n".'Ber,ber', 'fuu'),
            array(''),
            array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo')
        );
        $actual = $this->object->readNextRows();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Premature EOF
     */
    public function testExceptionThrownWhenPrematureEOF()
    {
        $object = new RfcReader(
             __DIR__ . '/_files/rfc_test_error.csv',
            $this->params['delimiter'],
            $this->params['fileCharset'],
            $this->params['mode']
        );
        $object->readNextRows();
    }

    public function getCsvData()
    {
        return array(
            array(
                '',
                array(''),
                ','
            ),
            array(
                "\r\n",
                array(''),
                ','
            ),
            array(
                'a,e,i,o,u',
                array('a', 'e', 'i', 'o', 'u'),
                ','
            ),
            array(
                "a,e,i,o,u\r\n",
                array('a', 'e', 'i', 'o', 'u'),
                ','
            ),
            array(
                'a;e;i;o;u',
                array('a', 'e', 'i', 'o', 'u'),
                ';'
            ),
            array(
                'foo,bar,,"foo ""bar""",foo bar,"foo, bar","""foo"" bar","\""foo\"" bar","""foo""'."\r\n".'Bar","foo'."\r\n".'""bar""","foo,'."\r\n".'Bar","foo'."\r\n".'Bar,bar",foo',
                array('foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar','"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar','foo'."\r\n".'"bar"','foo,'."\r\n".'Bar','foo'."\r\n".'Bar,bar', 'foo'),
                ','
            ),
        );
    }

    /**
     * @dataProvider getCsvData
     */
    public function testStringToArray($string, array $array, $delimiter)
    {
        $expected = $array;
        $actual = $this->object->stringToArray($string, $delimiter);
        $this->assertEquals($expected, $actual);
    }
}
