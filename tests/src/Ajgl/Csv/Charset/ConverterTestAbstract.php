<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset\Tests
 */
namespace Ajgl\Csv\Charset;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Charset\Tests
 */
abstract class ConverterTestAbstract
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ajgl\Csv\Charset\ConverterInterface
     */
    protected $object;

    public function getPangrams()
    {
        return array(
            array('ISO-8859-1', 'Fix, Schwyz!" quäkt Jürgen blöd vom Paß'), //DE
            array('ISO-8859-1', 'Jovencillo emponzoñado de Whisky: ¡qué figurota exhibe!'), //ES
            array('ISO-8859-15', "Le cœur déçu mais l'âme plutôt naïve, Louÿs rêva de crapaüter en canoë au delà des îles, près du mälströn où brûlent les novæ"), //FR
            array('ISO-8859-7', 'Θέλει αρετή και τόλμη η ελευθερία. (Ανδρέας Κάλβος)'), //GR
        );
    }
}
