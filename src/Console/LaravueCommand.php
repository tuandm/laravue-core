<?php
/**
 * File LaravueCommand.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */

namespace Tuandm\Laravue\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

/**
 * Class LaravueCommand
 *
 * @package Tuandm\Laravue\Console
 */
class LaravueCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'laravue:setup Setup API endpoint for Laravue, should be /api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set API endpoint for Laravue (/api)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Call jwt:secret command
        $this->call('jwt:secret');

        if (file_exists($path = $this->envPath()) === false) {
            $this->comment('Seems your .env does not exist, please setup.');

            return;
        }

        if (Str::contains(file_get_contents($path), 'BASE_API') === false) {
            // update existing entry
            file_put_contents($path, PHP_EOL . 'BASE_API=/api', FILE_APPEND);
            file_put_contents($path, PHP_EOL . 'MIX_BASE_API="${BASE_API}"', FILE_APPEND);
            $this->comment('Your BASE_API /api has been set successfully');
        } else {
            $this->comment('Your BASE_API already exists, please make sure Laravue will work with this endpoint.');

            return;
        }

        $this->setupBabel();
    }

    /**
     * Setup .babelrc file
     */
    protected function setupBabel()
    {
        $babelrcPath = $this->laravel->basePath('.babelrc');
        if (!file_exists($babelrcPath)) {
            $content = <<<JSON
{
  "presets": [
    [
      "@babel/preset-env",
      {
        "useBuiltIns": "entry"
      }
    ]
  ],
  "plugins": [
    "babel-plugin-syntax-dynamic-import",
    "@babel/plugin-transform-runtime",
    "babel-plugin-transform-vue-jsx"
  ]
}            
JSON;

            file_put_contents($babelrcPath, $content, FILE_APPEND);
            return;
        } else {
            $this->comment('Your .babelrc already exists, please reference installation guide to manually setup babel');
            return;
        }
    }

    /**
     * Get the .env file path.
     *
     * @return string
     */
    protected function envPath()
    {
        if (method_exists($this->laravel, 'environmentFilePath')) {
            return $this->laravel->environmentFilePath();
        }
        // check if laravel version Less than 5.4.17
        if (version_compare($this->laravel->version(), '5.4.17', '<')) {
            return $this->laravel->basePath() . DIRECTORY_SEPARATOR . '.env';
        }

        return $this->laravel->basePath('.env');
    }
}
