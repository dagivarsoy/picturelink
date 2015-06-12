# Picture link

[![Latest Version](https://img.shields.io/github/release/divarsoy/picturelink.svg?style=flat-square)](https://github.com/divarsoy/picturelink/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/divarsoy/picturelink/master.svg?style=flat-square)](https://travis-ci.org/divarsoy/picturelink)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/divarsoy/picturelink.svg?style=flat-square)](https://scrutinizer-ci.com/g/divarsoy/picturelink/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/divarsoy/picturelink.svg?style=flat-square)](https://scrutinizer-ci.com/g/divarsoy/picturelink)
[![Total Downloads](https://img.shields.io/packagist/dt/divarsoy/picturelink.svg?style=flat-square)](https://packagist.org/packages/divarsoy/picturelink)


This package aims to simplify the process of making responsive images.
## Prerequisites

* Node.js v0.10+ or io.js
* libvips v7.40.0+ (7.42.0+ recommended)
* C++11 compatible compiler such as gcc 4.6+, clang 3.0+ or MSVC 2013

## Install libvips

run the following as a user with sudo access:


``` bash
$ curl -s https://raw.githubusercontent.com/lovell/sharp/master/preinstall.sh | sudo bash -
```
or check out intall instructions at https://www.npmjs.com/package/sharp

## Install NPM packages

``` bash
$ npm install
```
## Install Picturelink

Via Composer

``` bash
$ composer require divarsoy/picturelink
```

## Usage
Setup source and destination folder in gulpfile.js
Then run

``` bash
$ gulp img
```
to resize all images in the source folder and output them to the destination folder. You can also setup a watcher with

``` bash
$ gulp watch[img]
```

You can now use picturelink in your php scripts with
``` php
$picturelink = new Divarsoy\Picturelink();
echo $picturelink->link( '/img/test.jpg', array(320,480,768,1024));
```
It will automatically download the lowest resolution image for the browser size.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/divarsoy/picturelink/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Dag A. Ivarsøy](https://github.com/divarsoy)
- [All Contributors](https://github.com/divarsoy/picturelink/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
