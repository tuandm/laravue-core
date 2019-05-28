# Laravue Core

The Laravel package to provide core functionalities for a beautiful [Laravel dashboard](https://laravue.dev)

Demo: https://core.laravue.dev

<p align="center">
  <img width="900" src="https://core.laravue.dev/images/laravue-core.jpg">
</p>

## Getting Started
[Laravue](https://github.com/tuandm/laravue) provides necessary Element UI and rich features for an enterprise admin dashboard, therefore it's highly recommended to use for starting a project. The following instructions are for intergrating core features of Laravue to existing Laravel project or to experiement with it.

### Prerequisites
[Laravue](https://github.com/tuandm/laravue) is built on top of [Laravel](https://laravel.com) and  so you have to check [Laravel's system requirement](https://laravel.com/docs/5.8/installation#server-requirements) and make sure your your [NodeJS](https://nodejs.org/en/) is ready before starting.

### Installing
Install laravue-core package with `composer`
```
composer require tuandm/laravue-core
```

#### 1.a Setup Laravue with all-in-one command
```
php artisan laravue:setup
```
This command will do these steps:
- Setup JWT secret and API endpoint
- Publish Laravue vendor packages/assets
- Install NPM dependencies
- Create .babelc file (if it doesn't exist)
- Setup webpack.mix.js (please backup this file to make sure the current setting will not be lost)

![Laravue setup](https://core.laravue.dev/images/laravue.gif)

#### 1.b Manual setup
It's recommended to use [laravue:setup command](#setup-laravue). If you want to manually install, you can do following setps:

##### .env file
Generate JWT secret for authentication
```
php artisan jwt:secret
```
Add these two lines to `.env` file
```
  BASE_API=/api
  MIX_BASE_API="${BASE_API}"
```

##### Publish vendor packages/assets
```
php artisan vendor:publish --provider="Tuandm\Laravue\ServiceProvider" --tag="laravue-core"
php artisan vendor:publish --provider="Tuandm\Laravue\ServiceProvider" --tag="laravue-asset"
```

##### Add NPM dependencies
```
npm add babel-plugin-syntax-dynamic-import babel-plugin-syntax-jsx babel-plugin-transform-vue-jsx eslint eslint-loader eslint-plugin-vue laravel-mix-eslint vue-template-compiler svg-sprite-loader --save-dev

npm add element-ui js-cookie normalize.css nprogress vuex vue-count-to vue-i18n vue-router 

npm install # To make sure everything is set
```

Please check [package.json sample](https://github.com/tuandm/laravue-core/tree/master/package.json.sample)

##### Webpack.mix.js configuration
We need to modify the webpack.mix.js to work with Laravue package, please refer to [webpack.mix.js sample](https://github.com/tuandm/laravue-core/tree/master/webpack.mix.js.sample)

Or simply run this command to generate recommendation version.

```
php artisan laravue:webpack
```

##### Babel
Laravue requires babel to build the packages. Usually, `.babelrc` will be generated with [laravue:setup command](#setup-laravue). Please manual add required plugins to `.babelrc` file if your project already uses it. Sample `.babelrc` can be found [here](https://github.com/tuandm/laravue-core/tree/master/.babelrc.sample)


#### 2. Config API guard
Open `config/auth.php` and modify as below

```
    # Change default auth guard to api
    'defaults' => [
        'guard' => 'api',
    ],
    ...
    # Use JWT driver for api guard
    'guards' => [
    ....
    'api' => [
        'driver' => 'jwt',
    ....
    
    # Use Laravue User model to authenticate
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Tuandm\Laravue\User::class,
        ],
``` 
Please refer to [auth.php sample](https://github.com/tuandm/laravue-core/tree/master/src/config/auth.php.sample)

#### 3. Database
Laravue core requires `users.role` field, consider to run migration if neccessary

```
php artisan migrate
```

#### 4. Sample data
This database seeder will insert 3 test users, you can ignore this step if you have data already.

```
php artisan db:seed --class=Tuandm\\Laravue\\Database\\Seeds\\DatabaseSeeder
```

### Start development

```
npm run dev # or npm run watch
```

### Build production

```
npm run production
```

## Running the tests

- Tests system is under development.

## Built with
* [Laravel](https://laravel.com/) - The PHP Framework For Web Artisans
* [VueJS](https://vuejs.org/) - The Progressive JavaScript Framework
* [Element](https://element.eleme.io/) - A  Vue 2.0 based component library for developers, designers and product managers
* [Vue Admin Template](https://github.com/PanJiaChen/vue-admin-template) - A minimal vue admin template with Element UI

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/tuandm/laravue-core/tags). 

## Authors

* **Tuan Duong** - *Initial work* - [tuandm](https://github.com/tuandm)

See also the list of [contributors](https://github.com/tuandm/laravue-core/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details

## Acknowledgements

* [Laravue](https://laravue.dev) - A beautiful dashboard for Laravel built by VueJS and ElementUI
* [vue-element-admin](https://panjiachen.github.io/vue-element-admin/#/) A magical vue admin which insprited Laravue project
* [tui.editor](https://github.com/nhnent/tui.editor) - Markdown WYSIWYG Editor
* [Echarts](http://echarts.apache.org/) - A powerful, interactive charting and visualization library for browser
