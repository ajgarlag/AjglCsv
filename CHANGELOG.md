# [CHANGELOG](http://keepachangelog.com/)
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [0.5.1] - 2020-12-18

### Changed
- Do not silence error in NativePhpWriter

## [0.5.0] - 2020-12-18

### Added
- Require phpunit/phpunit for development
- Require friendsofphp/php-cs-fixer for development and fix-cs
- Migrate code to PHP 7.3 adding scalar param type hints and return types
- Upgrade phpunit dependency and fix tests
- Migrate from travis-ci to github actions

### Changed
- Require PHP >=7.3 or >=8.0
- Require ajgl/csv:^0.4

### Removed
- Remove deprecated method Ajgl\Csv\Writer\RfcWriter::arrayToString

## [0.4.0] - 2016-02-25
### Added
- Add PHP 5.6 support
- Add PHP 7.0 support
- Add CHANGELOG.md file
- Leverage [ajgl/csv-rfc] for RFC related operations

### Changed
- Migration to PSR-4
- Leave gitflow workflow

### Deprecated
- Deprecate `Ajgl\Csv\Writer\RfcWriter::arrayToString`. It can be replaced by `Ajgl\Csv\Rfc\CsvRfcUtils::strPutCsv`
  from [ajgl/csv-rfc]

### Removed
- Remove PHP 5.3 support

## [0.3.0] - 2014-08-07

## [0.2.0] - 2014-03-21

## [0.1.0] - 2014-03-18

## [0.0.2] - 2012-11-18

## 0.0.1 - 2012-11-15

[Unreleased]: https://github.com/ajgarlag/AjglCsv/compare/0.5.1...master
[0.5.1]: https://github.com/ajgarlag/AjglCsv/compare/0.5.0...0.5.1
[0.5.0]: https://github.com/ajgarlag/AjglCsv/compare/0.4.0...0.5.0
[0.4.0]: https://github.com/ajgarlag/AjglCsv/compare/0.3.0...0.4.0
[0.3.0]: https://github.com/ajgarlag/AjglCsv/compare/0.2.0...0.3.0
[0.2.0]: https://github.com/ajgarlag/AjglCsv/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/ajgarlag/AjglCsv/compare/0.0.2...0.1.0
[0.0.2]: https://github.com/ajgarlag/AjglCsv/compare/0.0.1...0.0.2

[ajgl/csv-rfc]: https://github.com/ajgarlag/AjglCsvRfc
