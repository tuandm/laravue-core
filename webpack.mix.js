const mix = require('laravel-mix');

function resolve(dir) {
  return path.join(__dirname, '/src/resources/js', dir);
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
      '@': __dirname + '/src/resources/js'
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

mix.js('src/resources/js/app.js', 'src/public/js')
// Seems this issue is from webpack, we have to wait webpack 5: https://github.com/JeffreyWay/laravel-mix/issues/1870
// .extract(['vue', 'axios', 'vuex', 'vue-router', 'vue-i18n', 'element-ui'])
  .options({
  })
  .sass('src/resources/js/styles/index.scss', 'src/public/css');

if (mix.inProduction()) {
  // mix.version();
} else {
  // Development settings
  mix.sourceMaps()
    .webpackConfig({
      devtool: 'cheap-eval-source-map' // Fastest for development
    });
}
