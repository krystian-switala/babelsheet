<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataSaver\DataSaver;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class DataSaverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $concreteClass = Config::get('babelsheet.dataSaverClass');
        $this->app->bind(DataSaver::class, function (Application $app) use ($concreteClass) {
            return $app->make($concreteClass);
        });
    }
}
