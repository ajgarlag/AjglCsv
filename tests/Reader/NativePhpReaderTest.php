<?php

declare(strict_types=1);

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Tests\Reader;

use Ajgl\Csv\Reader\NativePhpReader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class NativePhpReaderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var NativePhpReader
     */
    protected $object;

    /**
     * @var array
     */
    protected $params = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->params = [
            'filePath' => __DIR__.'/_files/php_test.csv',
            'delimiter' => ',',
            'fileCharset' => 'ASCII',
            'mode' => 'r',
        ];
        $this->object = new NativePhpReader(
            $this->params['filePath'],
            $this->params['delimiter'],
            $this->params['fileCharset'],
            $this->params['mode']
        );
    }

    public function testReadNextRow(): void
    {
        $expected = ['foo', 'bar', '', 'foo "bar"', 'foo bar', 'foo, bar', '"foo" bar', '\"foo\" bar', '"foo"'."\r\n".'Bar', 'foo'."\r\n".'"bar"', 'foo,'."\r\n".'Bar', 'foo'."\r\n".'Bar,bar', 'foo'];
        $actual = $this->object->readNextRow();
        $this->assertEquals($expected, $actual);
    }

    public function testReadNextRows(): void
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
}
