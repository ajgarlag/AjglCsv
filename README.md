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


About
-----

AjglCsv is an [ajgarlag](http://aj.garcialagar.es) initiative.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/ajgarlag/AjglCsv/issues).
