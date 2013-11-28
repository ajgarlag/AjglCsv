<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\NativePhpReader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class NativePhpReaderTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NativePhpReader
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
            'filePath' => __DIR__ . '/_files/php_test.csv',
            'delimiter' => ',',
            'fileCharset' => 'ASCII',
            'mode' => 'r'
        );
        $this->object = new NativePhpReader(
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

    public function testReadNextRows()
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
}
