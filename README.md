## Laravel Core
The Laravel package to provide core functionalities of [Laravel dashboard](https://laravue.dev)

## Installations
#### Install laravue-core package

```
composer require tuandm/laravue-core
```
#### Setup environment for Laravue (API endpoint and JWT secret)

1. Setup Laravue
```
php artisan laravue:setup
```

2. Open `config/auth.php` and modify as below

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

#### Database
Laravue core requires `users.role` field, consider to run migration and data seeder (for sample data if necessary

```
php artisan migrate
php artisan db:seed --class=Tuandm\\Laravue\\Database\\Seeds\\DatabaseSeeder
```

#### Publish Laravue packages

```
php artisan vendor:publish --provider="Tuandm\Laravue\ServiceProvider" --tag="laravue-core"
php artisan vendor:publish --provider="Tuandm\Laravue\ServiceProvider" --tag="laravue-asset"
```

#### Add NPM dependencies
```
npm add babel-plugin-syntax-dynamic-import babel-plugin-syntax-jsx babel-plugin-transform-vue-jsx eslint eslint-loader eslint-plugin-vue laravel-mix-eslint vue-template-compiler svg-sprite-loader --save-dev

npm add element-ui js-cookie normalize.css nprogress vuex vue-count-to vue-i18n vue-router 

npm install # To make sure everything is set
```

Please check [package.json sample](https://github.com/tuandm/laravue-core/tree/master/package.json.sample)

#### Webpack.mix.js configuration
We need to modify the webpack.mix.js to work with Laravue package, please refer to [webpack.mix.js sample](https://github.com/tuandm/laravue-core/tree/master/webpack.mix.js.sample)

#### Start development

```
npm run dev # or npm run watch
```

#### Build production

```
npm run production
```
