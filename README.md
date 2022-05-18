<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Argon Tinker Modularization from Scratch
. the objective of this repo is to establish every module or service from scratch and work as atest platform pre to our work

## the argon documentation and startup
 can find [here](https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/installation.html#starter-template)

## Installation

After initializing a fresh instance of Laravel (and making all the necessary configurations), install the preset using one of the provided methods:
Via composer
- Cd to your Laravel app
- Type in your terminal: `composer require laravel/ui` and `php artisan ui vue --auth`
- Install this preset via `composer require laravel-frontend-presets/argon`. No need to register the service provider. Laravel 5.5 & up can auto detect the package.
- Run `php artisan ui argon` command to install the Argon preset. This will install all the necessary assets and also the custom auth views, it will also add the auth route in routes/web.php (NOTE: If you run this command several times, be sure to clean up the duplicate Auth entries in routes/web.php)
- In your terminal run `composer dump-autoload` or  `composer du`
- Run `php artisan migrate --seed` to create basic users table

## By using the archive

- In your application's root create a presets folder
- Download an archive of the repo and unzip it
- Copy and paste argon-master folder in presets (created in step 2) and rename it to argon
- Open composer.json file
- Add "LaravelFrontendPresets\\ArgonPreset\\": "presets/argon/src" to autoload/psr-4 and to autoload-dev/psr-4
- Add LaravelFrontendPresets\ArgonPreset\ArgonPresetServiceProvider::class to config/app.php file
- Type in your terminal: composer require laravel/ui and php artisan ui vue --auth
- In your terminal run composer dump-autoload
- Run php artisan ui argon command to install the Argon preset. This will install all the necessary assets and also the custom auth views, it will also add the auth route in routes/web.php (NOTE: If you run this command several times, be sure to clean up the duplicate Auth entries in routes/web.php)
- Run php artisan migrate --seed to create basic users table


## Usage

Register a user or login using admin@argon.com and secret and start testing the preset (make sure to run the migrations and seeders for these credentials to be available).

Besides the dashboard and the auth pages this preset also has a user management example and an edit profile page. All the necessary files (controllers, requests, views) are installed out of the box and all the needed routes are added to routes/web.php. Keep in mind that all of the features can be viewed once you login using the credentials provided above or by registering your own user.

## Dashboard

You can access the dashboard either by using the "Dashboard" link in the left sidebar or by adding /home in the url.

## CSS

Copy-paste the stylesheet <link> into your <head> before all other stylesheets to load our CSS.

```sh
<!-- Favicon -->
<link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="/assets/vendor/nucleo/css/nucleo.min.css" rel="stylesheet">
<link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="/assets/css/argon.min.css" rel="stylesheet">
```

## JS

Many of our components require the use of JavaScript to function. Specifically, they require jQuery, Popper.js, and our own JavaScript plugins. Place the following `<script>`s near the end of your pages, right before the closing `</body>` tag, to enable them. jQuery must come first, then Popper.js, and then our JavaScript plugins.

We use jQuery’s slim build, but the full version is also supported.

```sh
<!-- Core -->
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="/assets/js/argon.min.js"></script>
```

Need to use a certain plugin in your page? You can find out how to integrate them and make them work in the Plugins dedicated page. In this way you will be sure that your website is optimized and uses only the needed resources.

## Starter template

Be sure to have your pages set up with the latest design and development standards. That means using an HTML5 doctype and including a viewport meta tag for proper responsive behaviors. Put it all together and your pages should look like this:

```sh
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Argon Dashboard</title>

        <!-- Favicon -->
<link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="/assets/vendor/nucleo/css/nucleo.min.css" rel="stylesheet">
<link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="/assets/css/argon.min.css" rel="stylesheet">
    </head>

    <body>
        <h1>Hello, world!</h1>

        <!-- Core -->
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="/assets/js/argon.min.js"></script>
    </body>

</html>
```

## Important globals

Argon employs a handful of important global styles and settings that you’ll need to be aware of when using it, all of which are almost exclusively geared towards the normalization of cross browser styles. Let’s dive in.
HTML5 doctype

Bootstrap requires the use of the HTML5 doctype. Without it, you’ll see some funky incomplete styling, but including it shouldn’t cause any considerable hiccups.

```sh
<!doctype html>
<html lang="en">
  ...
</html>
```
## Responsive meta tag

Bootstrap is developed mobile first, a strategy in which we optimize code for mobile devices first and then scale up components as necessary using CSS media queries. To ensure proper rendering and touch zooming for all devices, add the responsive viewport meta tag to your <head>.

```sh
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
```
# Throw Error Unknown database
- do not forget to create your schemea first

```sh
create schema argon_tinker_from_scratch;
use argon_tinker_from_scratch;
```
- then generate the key
-  
```sh
php artisan key:generate
```
- then migrate the database and seed
```sh
php artisan migrate --seed
```

  