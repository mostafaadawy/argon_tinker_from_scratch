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

#  Facade methods
- Get all modules `Module::all();`
-  Get all cached modules `Module::getCached();`
-  Get ordered modules. The modules will be ordered by the priority key in module.json file `Module::getOrdered();`
-  Get scanned modules `Module::scan();`
-  Find a specific module `Module::find('name');` OR `Module::get('name');` Find a module, if there is one, return the Module instance, otherwise throw `Nwidart\Modules\Exeptions\ModuleNotFoundException`.
-  `Module::findOrFail('module-name');`
-  Get scanned paths.` Module::getScanPaths();`
-  Get all modules as a collection instance `Module::toCollection();`
-  Get modules by the status 1 for active and 0 for inactive `Module::getByStatus(1);`
-  Check the specified module. If it exists, will return true, otherwise false `Module::has('blog');`
-  Get all enabled modules `Module::allEnabled();`
-  Get all disabled modules `Module::allDisabled();`
-  Get count of all modules `Module::count();`
-  Get module path `Module::getPath();`
-  Register the modules `Module::register();`
-  Boot all available modules `Module::boot();`
-  Get all enabled modules as collection instance `Module::collections();`
-  Get module path from the specified module `Module::getModulePath('name');`
-  Get assets path from the specified module `Module::assetPath('name');`
-  Get config value from this package `Module::config('composer.vendor');`
-  Get used storage path `Module::getUsedStoragePath();`
-  Get used module for cli session `Module::getUsedNow();` OR `Module::getUsed();`
-  Set used module for cli session `Module::setUsed('name');`
-  Get modules's assets path `Module::getAssetsPath();`
-  Get asset url from specific module `Module::asset('blog:img/logo.img');`
-  Install the specified module by given module name `Module::install('nwidart/hello');`
-  Update dependencies for the specified module `Module::update('hello');`
-  Add a macro to the module repository `Module::macro('hello', function() { echo "I'm a macro";});`
-  Call a macro from the module repository `Module::hello();`
-  Get all required modules of a module `Module::getRequirements('module name');`
#  Module Methods
- Get an entity from a specific module `$module = Module::find('blog');`
- Get module name `$module->getName();`
  - Get module name in lowercase $module->getLowerName();
- Get module name in studlycase `$module->getStudlyName();`
- Get module path `$module->getPath();`
- Get extra path `$module->getExtraPath('Assets');`
- Disable the specified module `$module->disable();`
- Enable the specified module `$module->enable();`
- Delete the specified module `$module->delete();`
- Get an array of module requirements. Note: these should be aliases of the module `$module->getRequires();`

#  Publishing Modules

After creating a module and you are sure your module will be used by other developers. You can push your module to github, gitlab or bitbucket and after that you can submit your module to the packagist website.

You can follow this step to publish your module.
- Create A Module.
- Make sure that you mentioned the type of the module in the composer.json as laravel-module
- Push the module to github, bitbucket, gitlab etc. Make sure the repository name follows the convention then it will be moved to the right directory automatically. 
- The repo name should be like `<namespace>/<name>-module`, a `-module` at the end.
- Example: https://github.com/nWidart/article-module. This module will be installed in `Module/Article directory`.
- Submit your module to the packagist website. Submit to packagist is very easy, just give your github repository, click submit and you done.

## Have modules be installed in the Modules/ folder

- Published modules can be installed like other composer packages. In any Laravel project `install the nwidart/laravel-modules package` by following the instruction and then you can `install your own modules`. 
- One extra step you need to take to install the module into the Modules directory of the project.
- The extra step is to install an additional composer plugin, `joshbrw/laravel-module-installer` which will move the module files automatically. 
- If you need to install the modules other than the Modules directory then add the following in your module composer.json.
```sh
"extra": {
    "module-dir": "Custom"
}
```
- After installing the composer plugin onces, now to install the module you have to use the composer command as like other regular packages,
```sh
composer require nwidart/article-module
```
#  Module Resources

Your module will most likely contain what laravel calls resources, those contain configuration, views, translation files, etc. In order for you module to correctly load and if wanted publish them you need to let laravel know about them as in any regular package.

### Note
<div style="background:#444444; color:#fff">
Those resources are loaded in the service provider generated with a module (using module:make), unless the plain flag is used, in which case you will need to handle this logic yourself.</div>
### Note
<div style="background:#444444; color:#fff">
Don't forget to change the paths, in the following code snippets a "Blog" module is assumed.
Configuration</div>
```sh
$this->publishes([
    __DIR__.'/../Config/config.php' => config_path('blog.php'),
], 'config');
$this->mergeConfigFrom(
    __DIR__.'/../Config/config.php', 'blog'
);
```
### Views
```sh
$viewPath = base_path('resources/views/modules/blog');

$sourcePath = __DIR__.'/../Resources/views';

$this->publishes([
    $sourcePath => $viewPath
]);

$this->loadViewsFrom(array_merge(array_map(function ($path) {
    return $path . '/modules/blog';
}, \Config::get('view.paths')), [$sourcePath]), 'blog');
```
The main part here is the loadViewsFrom method call. If you don't want your views to be published to the laravel views folder, you can remove the call to the $this->publishes() call.
### Language files
```sh
 $langPath = base_path('resources/lang/modules/blog');

if (is_dir($langPath)) {
    $this->loadTranslationsFrom($langPath, 'blog');
} else {
    $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'blog');
}
```
### Factories

If you want to use laravel factories you will have to add the following in your service provider:
```sh
$this->app->singleton(Factory::class, function () {
    return Factory::construct(__DIR__ . '/Database/factories');
});
```
#  Module Console Commands

Your module may contain console commands. You can generate these commands manually, or with the following helper:
```sh
php artisan module:make-command CreatePostCommand Blog
```
This will create a CreatePostCommand inside the Blog module. By default this will be Modules/Blog/Console/CreatePostCommand.

Please refer to the laravel documentation on artisan commands to learn all about them.
### Registering the command

You can register the command with the laravel method called commands that is available inside a service provider class.
```sh
$this->commands([
    \Modules\Blog\Console\CreatePostCommand::class,
]);
```
You can now access your command via php artisan in the console.

##  Registering Module Events

Your module may contain events and event listeners. You can create these classes manually, or with the following helpers:
```sh
php artisan module:make-event BlogPostWasUpdated Blog
php artisan module:make-listener NotifyAdminOfNewPost Blog
```
Once those are create you need to register them in laravel. This can be done in 2 ways:
- Manually `calling $this->app['events']->listen(BlogPostWasUpdated::class, NotifyAdminOfNewPost::class);` in your module service provider
- Or by creating a event service provider for your module which will contain all its events, similar to the EventServiceProvider under the app/ namespace.

## Creating an EventServiceProvider

Once you have multiple events, you might find it easier to have all events and their listeners in a dedicated service provider. This is what the EventServiceProvider is for.

- Create a new class called for instance EventServiceProvider in the Modules/Blog/Providers folder (Blog being an example name)
- This class needs to look like this:
```sh
<?php

namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [];
}
```
- Don't forget to load this service provider, for instance by adding it in the module.json file of your module. 
- This is now like the regular EventServiceProvider in the app/ namespace. In our example the listen property will look like this:
```sh
// ...
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BlogPostWasUpdated::class => [
            NotifyAdminOfNewPost::class,
        ],
    ];
}
```
# Adding accounting module app roughly
- copying all views
- copying all controllers
- copying all providers except routeservice provider
- copying all middlewares
- copying all models
- copying all lang files
- removing unwanted route and copying all routes after editing and removing /accounting where we are inside the prefix
- removing unwanted index and controller
- next step it to edit the module to the samilar module in club

# Editing module to get it work refrence club payroll module

## Config config.php 
- adding some requirements for club app not for standard module
- delete unwanted console folder
- delete unwanted factories in database folder
- remove unwanted getkeep files
- structure the entities to mimic other module structure
- editing entities file namespace and paths
- structure the controller to mimic other module structure
- editing controllers file namespace and paths
- requiiring yajara datatable `composer require yajra/laravel-datatables:^1.5`
- requiring pdf package `composer require elibyy/tcpdf-laravel`
- removing all middleware cause the bascontroller is in the parent app
- nothing in our module custom request for validations
- removing node_module where it will be installed in parent
- removing all providers where it is used from parent except module provider "AccountingServiceProvider" which acting ass appServiceProvider and also keep RouteServiceProvider
- structuring lang folder to have two folders for arabic and english
- 
