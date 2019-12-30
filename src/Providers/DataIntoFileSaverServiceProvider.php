<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\DataSaver\DataIntoFileSaver;
use Tsh\Babelsheet\ArrayToStringParser;
use Illuminate\Support\Facades\Storage;

class DataIntoFileSaverServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DataIntoFileSaver::class, function () {
            return new DataIntoFileSaver(
                new ArrayToStringParser(),
                Storage::createLocalDriver([
                    'root' => base_path(),
                ])
            );
        });
    }
}