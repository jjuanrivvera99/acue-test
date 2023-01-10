# Acue Test


[![Software License][ico-license]](LICENSE.md)

## Structure

```
app/
bootstrap/
config/
database/
docker/
public/
resources/
routes/
storage/
tests/
vendor/
```

## Install

``` bash
$ git clone https://github.com/jjuanrivvera99/acue-test.git
$ cd acue-test
```

## Setup for development

``` bash
$ cp .env.example .env
$ docker-compose up -d
$ docker-compose exec laravel.test bash
$ composer install
$ php artisan key:generate
$ npm install
$ npm run dev
```

## Run in production

``` bash
$ cp .env.example .env
$ docker-compose -f docker-compose-prod.yml up -d
$ docker-compose exec php sh
$ composer install --no-dev
$ php artisan key:generate
$ php artisan optimize
```

## Credits

- [jjuanrivvera99](https://github.com/jjuanrivvera99)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

[link-author]: https://github.com/jjuanrivvera99
