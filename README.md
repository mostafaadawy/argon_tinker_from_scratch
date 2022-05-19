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

## Modules

nwidart modules package [link](https://nwidart.com/laravel-modules/v6/introduction)

- require it first `composer require nwidart/laravel-modules`
- then publish it `php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"`
- Autoloading: By default the module classes are not loaded automatically. You can autoload your modules using psr-4. For example :
```sh
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "Modules/"
    }
  }
}
```
Tip: don't forget to run `composer dump-autoload` afterwards

##  Creating a module

- Creating a module is simple and straightforward. Run the following command to create a module.

```sh
php artisan module:make <module-name>
```

- Replace `<module-name>` by your desired name.
- It is also possible to create multiple modules in one command.

```sh
php artisan module:make Blog User Auth
```

- By default when you create a new module, the command will add some resources like a controller, seed class, service provider, etc. automatically. If you don't want these, you can add `--plain` flag, to generate a plain module.

```sh
php artisan module:make Blog --plain
```
# or
```sh
php artisan module:make Blog -p
```
### Naming convention

Because we are autoloading the modules using psr-4, we strongly recommend using StudlyCase convention.

##  Custom namespaces

When you create a new `module` it also registers new custom namespace for Lang, View and Config. For example, if you create a new module named blog, it will also `register` new `namespace/hint` blog for that module. Then, you can `use` that namespace for calling Lang, View or Config. Following are some examples of its usage:

## Calling Lang:
```sh
Lang::get('blog::group.name');

@trans('blog::group.name');
```
## Calling View:
```sh
view('blog::index')

view('blog::partials.sidebar')
```
## Calling Config:
```sh
Config::get('blog.name')
```

## Configuration

You can publish the package configuration using the following command:
```sh
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```
In the published configuration file you can configure the following things:
### Default namespace

What the default namespace will be when generating modules.

Key: `namespace`

Default: `Modules`

### Overwrite the generated files

Overwrite the default generated stubs to be used when generating modules. This can be useful to customise the output of different files.

Key: `stubs`

### Overwrite the paths

Overwrite the default paths used throughout the package.

Key: `paths`

### Scan additional folders for modules

This is disabled by default. Once enabled, the package will look for modules in the specified array of paths.

Key: `scan`

### Composer file template

Customise the generated `composer.json` file.

Key: `composer`

### Caching

If you have many modules it's a good idea to cache this information (like the multiple module.json files for example).

Key: `cache`

### Registering custom namespace

Decide which custom namespaces need to be registered by the package. If one is set to false, the package won't handle its registration.

Key: `register`

##  Helpers
### Module path function

Get the path to the given module.
```sh
$path = module_path('Blog');
```
##  Compiling Assets (Laravel Mix)
### Installation & Setup

When you create a new module it also create assets for CSS/JS and the webpack.mix.js configuration file.
```sh
php artisan module:make Blog
```
- Change directory to the module:
```sh
cd Modules/Blog
```
The default package.json file includes everything you need to get started. You may install the dependencies it references by running:
```sh
npm install
```
### Running Mix

Mix is a configuration layer on top of Webpack, so to run your Mix tasks you only need to execute one of the NPM scripts that is included with the default laravel-modules package.json file
```sh
// Run all Mix tasks...
npm run dev

// Run all Mix tasks and minify output...
npm run production
```
- This may require additiona dependancies installation 
```sh
Additional dependencies must be installed. This will only take a moment.
 
        Running: npm install sass-loader@^12.1.0 sass resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps
 
        Finished. Please run Mix again.
```
After generating the versioned file, you won't know the exact file name. So, you should use Laravel's global mix function within your views to load the appropriately hashed asset. The mix function will automatically determine the current name of the hashed file:
```sh
// Modules/Blog/Resources/views/layouts/master.blade.php

<link rel="stylesheet" href="{{ mix('css/blog.css') }}">

<script src="{{ mix('js/blog.js') }}"></script>
```
For more info on Laravel Mix view the documentation here: https://laravel.com/docs/mix
- Note: to prevent the main Laravel Mix configuration from overwriting the public/mix-manifest.json file:

### Install laravel-mix-merge-manifest
```sh
npm install laravel-mix-merge-manifest --save-dev
```
### Modify webpack.mix.js main file
```sh
let mix = require('laravel-mix');
/* Allow multiple Laravel Mix applications*/
require('laravel-mix-merge-manifest');
mix.mergeManifest();
/*----------------------------------------*/
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
```
#  Artisan commands
Useful Tip:
<div style="background:#444444; color:#fff">
You can use the following commands with the --help suffix to find its arguments and options.
Note all the following commands use "Blog" as example module name, and example class/file names
</div>

### Utility commands `module:make`
### Generate a new module `php artisan module:make Blog`
### Generate multiple modules at once `php artisan module:make Blog User Auth`
### module:use
Use a given module. This allows you to not specify the module name on other commands requiring the module name as an argument `php artisan module:use Blog`
### module:unuse
This unsets the specified module that was set with the module:use command `php artisan module:unuse`
### module:list
List all available modules `php artisan module:list`
### module:migrate
- Migrate the given module, or without a module an argument, migrate all modules `php artisan module:migrate Blog` 
- Rollback the given module `module:migrate-rollback`, or without an argument, rollback all modules `php artisan module:migrate-rollback Blog`
### module:migrate-refresh
Refresh the migration for the given module, or without a specified module refresh all modules migrations `php artisan module:migrate-refresh Blog`
### module:migrate-reset Blog
Reset the migration for the given module, or without a specified module reset all modules migrations `php artisan module:migrate-reset Blog`
### module:seed
Seed the given module, or without an argument, seed all modules `php artisan module:seed Blog`
### module:publish-migration
Publish the migration files for the given module, or without an argument publish all modules migrations `php artisan module:publish-migration Blog`
### module:publish-config
Publish the given module configuration files, or without an argument publish all modules configuration files `php artisan module:publish-config Blog`
### module:publish-translation
Publish the translation files for the given module, or without a specified module publish all modules migrations `php artisan module:publish-translation Blog`
### module:enable
Enable the given module `php artisan module:enable Blog`
### module:disable
Disable the given module `php artisan module:disable Blog`
### module:update
Update the given module `php artisan module:update Blog`
## Generator commands
### module:make-command
Generate the given console command for the specified module `php artisan module:make-command CreatePostCommand Blog`
### module:make-migration
Generate a migration for specified module `php artisan module:make-migration create_posts_table Blog`
### module:make-seed
Generate the given seed name for the specified module `php artisan module:make-seed seed_fake_blog_posts Blog`
### module:make-controller
Generate a controller for the specified module `php artisan module:make-controller PostsController Blog`
### module:make-model
Generate the given model for the specified module `php artisan module:make-model Post Blog`
## Optional options:
    --fillable=field1,field2: set the fillable fields on the generated model
    --migration, -m: create the migration file for the given model

## module:make-provider
Generate the given service provider name for the specified module `php artisan module:make-provider BlogServiceProvider Blog`
### module:make-middleware
Generate the given middleware name for the specified module `php artisan module:make-middleware CanReadPostsMiddleware Blog`
### module:make-mail
Generate the given mail class for the specified module `php artisan module:make-mail SendWeeklyPostsEmail Blog`
### module:make-notification
Generate the given notification class name for the specified module `php artisan module:make-notification NotifyAdminOfNewComment Blog`
### module:make-listener
Generate the given listener for the specified module. Optionally you can specify which event class it should listen to. It also accepts a --queued flag allowed queued event listeners 
```sh
php artisan module:make-listener NotifyUsersOfANewPost Blog
php artisan module:make-listener NotifyUsersOfANewPost Blog --event=PostWasCreated
php artisan module:make-listener NotifyUsersOfANewPost Blog --event=PostWasCreated --queued
```
### module:make-request
Generate the given request for the specified module `php artisan module:make-request CreatePostRequest Blog`
### module:make-event
Generate the given event for the specified module `php artisan module:make-event BlogPostWasUpdated Blog`
### module:make-job
Generate the given job for the specified module.
```sh
php artisan module:make-job JobName Blog
php artisan module:make-job JobName Blog --sync # A synchronous job class
```
### module:route-provider
Generate the given route service provider for the specified module `php artisan module:route-provider Blog`
### module:make-factory
Generate the given database factory for the specified modulen `php artisan module:make-factory FactoryName Blog`
### module:make-policy
Generate the given policy class for the specified module. The Policies is not generated by default when creating a new module. Change the value of paths.generator.policies in modules.php to your desired location `php artisan module:make-policy PolicyName Blog`
### module:make-rule
Generate the given validation rule class for the specified module. The Rules folder is not generated by default when creating a new module. Change the value of paths.generator.rules in modules.php to your desired location `php artisan module:make-rule ValidationRule Blog`
### module:make-resource
Generate the given resource class for the specified module. It can have an optional --collection argument to generate a resource collection. The Transformers folder is not generated by default when creating a new module. Change the value of paths.generator.resource in modules.php to your desired location.
```sh
php artisan module:make-resource PostResource Blog
php artisan module:make-resource PostResource Blog --collection
```
### module:make-test
Generate the given test class for the specified module `php artisan module:make-test EloquentPostRepositoryTest Blog`

