<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataSaver\DataSaver;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class DataSaverServiceProvider extends ServiceProvider
{
    private const CONCRETE_CLASS_KEY = 'babelsheet.dataSaverClass';

    public function register(): void
    {
        $concreteClass = Config::get(self::CONCRETE_CLASS_KEY);
        $this->app->bind(DataSaver::class, function (Application $app) use ($concreteClass) {
            return $app->make($concreteClass);
        });
    }
}
