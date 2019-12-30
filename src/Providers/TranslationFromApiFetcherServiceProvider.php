<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataFetcher\TranslationFromApiFetcher;
use Illuminate\Support\Facades\Config;

class TranslationFromApiFetcherServiceProvider extends ServiceProvider
{
    private const API_URL_CONFIG_KEY = 'babelsheet.apiUrl';

    public function register()
    {
        $apiUrl = Config::get(self::API_URL_CONFIG_KEY);
        $this->app->bind(TranslationFromApiFetcher::class, function () use ($apiUrl) {
            return new TranslationFromApiFetcher(new Client(), $apiUrl);
        });
    }
}
