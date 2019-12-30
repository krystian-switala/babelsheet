<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\Babelsheet;
use Illuminate\Foundation\Application;
use Tsh\Babelsheet\DataFetcher\TranslationsDataFetcher;
use Tsh\Babelsheet\DataSaver\DataSaver;

class BabelsheetServiceProvider extends ServiceProvider
{
    private const PATH_TO_CONFIG_FILE = __DIR__ . '/../../config/config.php';
    private const CONFIG_FILE_NAME = 'babelsheet.php';

    public function register(): void
    {
        $this->app->bind(Babelsheet::class, function (Application $app) {
            return new Babelsheet(
                $app->make(TranslationsDataFetcher::class),
                $app->make(DataSaver::class)
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            self::PATH_TO_CONFIG_FILE => config_path(self::CONFIG_FILE_NAME),
        ]);
    }
}
