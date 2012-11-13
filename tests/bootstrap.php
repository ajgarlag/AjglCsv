<?php
PHPUnitBootstrap::setUp();

/**
 * Class to bootstrap the tests
 */
abstract class PHPUnitBootstrap
{
    protected static $initialized = false;

    protected static function init()
    {
        if (!self::$initialized) {
            // Ensure src/ is on include_path
            set_include_path(
                implode(
                    PATH_SEPARATOR,
                    array(
                        realpath(__DIR__ . '/../src'),
                        get_include_path(),
                    )
                )
            );
            require_once 'PHPUnit/Autoload.php';
            /* @var $loader \Composer\Autoload\ClassLoader */
            $loader = require __DIR__.'/../vendor/autoload.php';
            $loader->add('Ajgl', __DIR__ . '/src');
        }
        self::$initialized = true;
    }

    /**
     * Set up the bootstrap
     */
    public static function setUp()
    {
        self::init();
    }
}
