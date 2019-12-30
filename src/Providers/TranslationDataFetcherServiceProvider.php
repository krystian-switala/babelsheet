<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataFetcher\TranslationFromApiFetcher;
use Tsh\Babelsheet\DataFetcher\TranslationsDataFetcher;
use GuzzleHttp\Client;

class TranslationDataFetcherServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TranslationsDataFetcher::class, function () {
            return new TranslationFromApiFetcher(new Client());
        });
    }
}
