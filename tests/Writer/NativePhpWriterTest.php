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

namespace Ajgl\Csv\Tests\Writer;

use Ajgl\Csv\Writer\NativePhpWriter;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class NativePhpWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ajgl\Csv\Writer\NativePhpWriter
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
            'filePath' => tempnam(sys_get_temp_dir(), 'test_'),
            'delimiter' => ';',
            'outputCharset' => 'ASCII',
            'mode' => 'w+',
        ];
        $this->object = new NativePhpWriter(
            $this->params['filePath'],
            $this->params['delimiter'],
            $this->params['outputCharset'],
            $this->params['mode']
        );
    }

    public function testWrite(): void
    {
        $this->object->writeRow(['foo', 'bar', 'fú', 'foo"bar\"']);
        $this->object->close();
        $expected = 'foo;bar;f?;"foo""bar\""'.PHP_EOL;
        $actual = file_get_contents($this->object->getFilePath());
        $this->assertEquals($expected, $actual);
    }
}
