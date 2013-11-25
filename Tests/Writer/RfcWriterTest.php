<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Tests\Writer;

use Ajgl\Csv\Writer\RfcWriter;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcPhpWriterTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ajgl\Csv\Writer\RfcWriter
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
            'filePath' => tempnam(sys_get_temp_dir(), 'test_'),
            'mode' => 'w+',
            'delimiter' => ';',
            'outputCharset' => 'ASCII'
        );
        $this->object = new RfcWriter(
            $this->params['filePath'],
            $this->params['mode'],
            $this->params['delimiter'],
            $this->params['outputCharset']
        );
    }

    public function testWrite()
    {
        $this->object->writeRow(array('foo', 'bar', 'fú', 'foo"bar\"'));
        $this->object->close();
        $expected = 'foo;bar;f ;"foo""bar\"""'.RfcWriter::EOL;
        $actual = file_get_contents($this->object->getFilePath());
        $this->assertEquals($expected, $actual);
    }
}
