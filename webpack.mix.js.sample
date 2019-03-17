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
      processCssUrls: false
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
