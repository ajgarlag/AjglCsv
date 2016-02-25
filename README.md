AjglCsv
=======

The AjglCsv component allows you to read and write CSV files.

[![Build Status](https://travis-ci.org/ajgarlag/AjglCsv.png?branch=master)](https://travis-ci.org/ajgarlag/AjglCsv)
[![Latest Stable Version](https://poser.pugx.org/ajgl/csv/v/stable.png)](https://packagist.org/packages/ajgl/csv)
[![Latest Unstable Version](https://poser.pugx.org/ajgl/csv/v/unstable.png)](https://packagist.org/packages/ajgl/csv)
[![Total Downloads](https://poser.pugx.org/ajgl/csv/downloads.png)](https://packagist.org/packages/ajgl/csv)
[![Montly Downloads](https://poser.pugx.org/ajgl/csv/d/monthly.png)](https://packagist.org/packages/ajgl/csv)
[![Daily Downloads](https://poser.pugx.org/ajgl/csv/d/daily.png)](https://packagist.org/packages/ajgl/csv)
[![License](https://poser.pugx.org/ajgl/csv/license.png)](https://packagist.org/packages/ajgl/csv)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/badges/quality-score.png?s=07ede5e0d7f8f6f5065277af7eecbc677c283ee8)](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/)
[![Code Coverage](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/badges/coverage.png?s=00d4254cea1de1ad74e1cacd64d9eef771205ba8)](https://scrutinizer-ci.com/g/ajgarlag/AjglCsv/)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/47a8fbe8-c9f7-48d8-a0e7-4b3906d8e48f/mini.png)](https://insight.sensiolabs.com/projects/47a8fbe8-c9f7-48d8-a0e7-4b3906d8e48f)

There are currently two different implementations for the reader and writer classes:

 * An implementation using the native [fgetcsv] and [fputcsv] functions
 * An implementation compatible with the [RFC 4180]


Installation
------------

To install the latest stable version of this component, open a console and execute the following command:
```
$ composer require ajgl/csv
```


Usage
-----

The simplest way to use this library is to create a Ajgl\Csv\Csv instance with:
```php
$csv = Ajgl\Csv\Csv::create();
```

By default, the library uses the native f??tcsv functions. If you want to read
or write [RFC 4180] compatible files, you should set the default reader and writer
types to ```rfc``` with:
```php
$csv->setDefaultReaderType('rfc');
$csv->setDefaultWriterType('rfc');
```

To create a new CSV reader or writer, you should call:
```php
$reader = $csv->createReader('/path/to/input.csv');
$writer = $csv->createWriter('/path/to/output.csv');
```


Symfony Bundle
--------------

If you need to integrate these library into your Symfony Framework app, you
can install the [AjglCsvBundle].


License
-------

This component is under the MIT license. See the complete license in the [LICENSE] file.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker].


Author Information
------------------

Developed with ♥ by [Antonio J. García Lagar].

If you find this component useful, please add a ★ in the [GitHub repository page] and/or the [Packagist package page].

[fgetcsv]: http://www.php.net/manual/function.fgetcsv.php
[fputcsv]: http://www.php.net/manual/function.fputcsv.php
[RFC 4180]: https://tools.ietf.org/html/rfc4180
[AjglCsvBundle]: https://github.com/ajgarlag/AjglCsvBundle
[LICENSE]: LICENSE
[Github issue tracker]: https://github.com/ajgarlag/AjglCsv/issues
[Antonio J. García Lagar]: http://aj.garcialagar.es
[GitHub repository page]: https://github.com/ajgarlag/AjglCsv
[Packagist package page]: https://packagist.org/packages/ajgl/csv
