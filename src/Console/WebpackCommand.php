<?php
/**
 * File WebpackCommand.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */

namespace Tuandm\Laravue\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

/**
 * Class WebpackCommand
 *
 * @package Tuandm\Laravue\Console\Laravue
 */
class WebpackCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'laravue:webpack Setup webpack.mix.js file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup webpack.mix.js file for Laravue project - this command will replace current file - be careful.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->confirm('This command will replace your current webpack.mix.js. Do you wish to continue?')) {
            $this->setupWebpack();
        }
    }

    /**
     * Setup webpack.mix.js file
     */
    protected function setupWebpack()
    {
        $webpackPath = $this->laravel->basePath('webpack.mix.js');
        $content = <<<JSON
const mix = require('laravel-mix');

function resolve(dir) {
   return path.join(__dirname, '/resources/vendor/laravue', dir);
}

Mix.listen('configReady', (webpackConfig) => {
   // Add "svg" to image loader test
   let imageLoaderConfig = webpackConfig.module.rules.find(rule => String(rule.test) === String(/(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/));
   imageLoaderConfig.exclude = resolve('icons');
})

mix.webpackConfig({
   resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
         'vue$': 'vue/dist/vue.esm.js',
         '@': __dirname + '/resources/vendor/laravue'
      },
   },
   module: {
      rules: [
         {
            test: /\.svg$/,
            loader: 'svg-sprite-loader',
            include: [resolve('icons')],
            options: {
               symbolId: 'icon-[name]'
            }
         },
      ],
   }
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/vendor/laravue/app.js', 'public/js')
   // .extract(['vue', 'axios', 'vuex', 'vue-router', 'vue-i18n', 'element-ui'])
   .options({
   })
   .sass('resources/vendor/laravue/styles/index.scss', 'public/css');

if (mix.inProduction()) {
   mix.version();
} else {
   // Development settings
   mix.sourceMaps()
      .webpackConfig({
         devtool: 'cheap-eval-source-map' // Fastest for development
      });
}

JSON;
        file_put_contents($webpackPath, $content);
        $this->info('webpack.mix.js has been set successfully');
    }
}
