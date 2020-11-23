# Laravel TikTok API

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/daaner/tiktok/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/daaner/tiktok/?branch=master)
[![Laravel Support](https://img.shields.io/badge/Laravel-7+-brightgreen.svg)]()
[![PHP Support](https://img.shields.io/badge/PHP-7.2.5+-brightgreen.svg)]()
[![Latest Stable Version](https://poser.pugx.org/daaner/tiktok/v)](//packagist.org/packages/daaner/tiktok)
[![Official Site](https://img.shields.io/badge/official-site-blue.svg)](https://tiktok.com/)
[![Total Downloads](https://poser.pugx.org/daaner/tiktok/downloads)](//packagist.org/packages/daaner/tiktok)
[![License](https://poser.pugx.org/daaner/tiktok/license)](//packagist.org/packages/daaner/tiktok)

Scraper TikTok ([tiktok.com](https://tiktok.com/)) using this Laravel framework package ([Laravel](https://laravel.com)).


#### Requirement
- Laravel >= 7
- PHP >= 7.2.5

## Install
Install package.

``` bash
composer require daaner/tiktok
```


Add provider and facade in `config/app.php`.

```php
Daaner\TikTok\TikTokServiceProvider::class,

// ---
'TikTok' => Daaner\TikTok\Facades\TikTok::class,
```

Publish the config and localization files with the command:

``` bash
php artisan vendor:publish --provider="Daaner\TikTok\TikTokServiceProvider"
```

## Configuration
No special settings are needed. Queries also work with default settings. If you need finer settings, change the config file `config/tiktok.php` after
If necessary, write the settings to a `.env`.


## Used
Use the model you want and get an array.


## Model - UserInfo

- `getUser($userName)` - Get user data by name (full array)
- `getUserInfo($userName)` - Get simple user data by name (only main and secondary array)

```php
use Daaner\TikTok\Models\UserInfo;

$tt = new UserInfo;
$user = $tt->getUser('tiktok');
//or
$user = $tt->getUser('@tiktok');
// or for simple info
$user = $tt->getUserInfo('tiktok');

dd($user);
```


## Model - TagInfo

- `getTag($tag)` - Get tag info
- `getTagInfo($tag)` - Get tag simple info
- `getTagApi($id, $count = 30, $cursor = 0)` - Get tag id data

```php
use Daaner\TikTok\Models\TagInfo;

$tt = new TagInfo;
$tag = $tt->getTag('apple');
//or
$tag = $tt->getTag('#apple');
// or for simple
$tag = $tt->getTagInfo('apple');

//and API data
$tag = $tt->getTagApi('13100', 10, 0);

dd($tag);
```


## Model - MusicInfo

- `getMusic($music)` - Get music info
- `getMusicInfo($music)` - Get music simple info
- `getMusicApi($id, $count = 30, $cursor = 0)` - Get music id data (count shows 1 item less only this API query)))))

```php
use Daaner\TikTok\Models\MusicInfo;

$tt = new MusicInfo;
$music = $tt->getMusic('I-JUST-FELL-6768866707013388289');
// or for simple
$music = $tt->getMusicInfo('I-JUST-FELL-6768866707013388289');

//and API data
$music = $tt->getMusicApi('6728860413338847233', 10, 2);

dd($music);
```


## Model - DiscoverInfo

- `getDiscover()` - Get discover info
- `getDiscoverApi($type)` - Get Suggested data

```php
use Daaner\TikTok\Models\DiscoverInfo;

$tt = new DiscoverInfo;
$discover = $tt->getDiscover();

//and API data
$discover = $tt->getDiscoverApi('user');
//or
$discover = $tt->getDiscoverApi('music');
//or
$discover = $tt->getDiscoverApi('challenge');

dd($discover);
```




## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daan](https://github.com/daaner)
- [Kirill](https://github.com/kastahov)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
