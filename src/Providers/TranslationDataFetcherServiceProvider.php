<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataFetcher\TranslationsDataFetcher;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class TranslationDataFetcherServiceProvider extends ServiceProvider
{
    private const CONCRETE_CLASS_KEY = 'babelsheet.dataFetcherClass';

    public function register(): void
    {
        $concreteClass = Config::get(self::CONCRETE_CLASS_KEY);
        $this->app->bind(TranslationsDataFetcher::class, function (Application $app) use ($concreteClass) {
            return $app->make($concreteClass);
        });
    }
}
