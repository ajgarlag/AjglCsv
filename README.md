AjglCsv
=======

The AjglCsv component allows you to read and write CSV files.

There are currently two different implementations for the reader and writer classes:

 * An implementation using the native [fgetcsv](www.php.net/manual/function.fgetcsv.php) and [fputcsv](www.php.net/manual/function.fputcsv.php) functions
 * An implementation compatible with the [RFC 4180](http://tools.ietf.org/html/rfc4180)


Usage
-----

The simplest way to use this library is to create a Ajgl\Csv\Csv instance with:
```php
$csv = Ajgl\Csv\Csv::create();
```

By default, the library uses the native f??tcsv functions. If you want to read
or write [RFC 4180](http://tools.ietf.org/html/rfc4180) compatible files, you
should set the default reader and writer types to ```rfc``` with:
```php
$csv->setDefaultReaderType('rfc');
$csv->setDefaultWriterType('rfc');
```

To create a new CSV reader or writer, you should call:
```php
$reader = $csv->createReader('/path/to/input.csv');
$writer = $csv->createReader('/path/to/output.csv');
```


Symfony Bundle
--------------

If you need to integrate these library into your Symfony Framework app, you
can install the [AjglCsvBundle](https://github.com/ajgarlag/AjglCsvBundle)


License
-------

This component is under the MIT license. See the complete license in the LICENSE file.


Badges
------

* **Travis CI**: [![Build Status](https://travis-ci.org/ajgarlag/AjglCsv.png?branch=master)](https://travis-ci.org/ajgarlag/AjglCsv)
* **Poser Latest Stable Version:** [![Latest Stable Version](https://poser.pugx.org/ajgl/csv/v/stable.png)](https://packagist.org/packages/ajgl/csv)
* **Poser Latest Unstable Version** [![Latest Unstable Version](https://poser.pugx.org/ajgl/csv/v/unstable.png)](https://packagist.org/packages/ajgl/csv)
* **Poser Total Downloads** [![Total Downloads](https://poser.pugx.org/ajgl/csv/downloads.png)](https://packagist.org/packages/ajgl/csv)
* **Poser Monthly Downloads** [![Montly Downloads](https://poser.pugx.org/ajgl/csv/d/monthly.png)](https://packagist.org/packages/ajgl/csv)
* **Poser Daily Downloads** [![Daily Downloads](https://poser.pugx.org/ajgl/csv/d/daily.png)](https://packagist.org/packages/ajgl/csv)
* **Poser License** [![License](https://poser.pugx.org/ajgl/csv/license.png)](https://packagist.org/packages/ajgl/csv)
* **Scrutinizer Quality** [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/badges/quality-score.png?s=07ede5e0d7f8f6f5065277af7eecbc677c283ee8)](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/)
* **Scrutinizer Code Coverage** [![Code Coverage](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/badges/coverage.png?s=00d4254cea1de1ad74e1cacd64d9eef771205ba8)](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/)
* **SensionLabs Insight Quality** [![SensioLabsInsight](https://insight.sensiolabs.com/projects/47a8fbe8-c9f7-48d8-a0e7-4b3906d8e48f/mini.png)](https://insight.sensiolabs.com/projects/47a8fbe8-c9f7-48d8-a0e7-4b3906d8e48f)
* **VersionEye Dependency Status** [![Dependency Status](https://www.versioneye.com/php/ajgl:csv/dev-master/badge.png)](https://www.versioneye.com/php/ajgl:csv/dev-master)


About
-----

AjglCsv is an [ajgarlag](http://aj.garcialagar.es) initiative.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/ajgarlag/AjglCsv/issues).
