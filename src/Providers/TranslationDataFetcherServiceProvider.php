<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataFetcher\TranslationsDataFetcher;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class TranslationDataFetcherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $concreteClass = Config::get('babelsheet.dataFetcherClass');
        $this->app->bind(TranslationsDataFetcher::class, function (Application $app) use ($concreteClass) {
            return $app->make($concreteClass);
        });
    }
}
