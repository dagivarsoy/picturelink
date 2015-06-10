# Picture link

[![Latest Version](https://img.shields.io/github/release/divarsoy/picturelink.svg?style=flat-square)](https://github.com/divarsoy/picturelink/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/divarsoy/picturelink/master.svg?style=flat-square)](https://travis-ci.org/divarsoy/picturelink)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/divarsoy/picturelink.svg?style=flat-square)](https://scrutinizer-ci.com/g/divarsoy/picturelink/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/divarsoy/picturelink.svg?style=flat-square)](https://scrutinizer-ci.com/g/divarsoy/picturelink)
[![Total Downloads](https://img.shields.io/packagist/dt/divarsoy/picturelink.svg?style=flat-square)](https://packagist.org/packages/divarsoy/picturelink)


This package aims to simplify the process of making responsive images.

## Install

Via Composer

``` bash
$ composer require divarsoy/picturelink
```

## Usage

``` php
$picturelink = new Divarsoy\Picturelink();
echo $picturelink->link( '/img/test.jpg', array(320,480,768,1024));
```

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
