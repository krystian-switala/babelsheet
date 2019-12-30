<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Tsh\Babelsheet\ArrayToStringParser;
use Tsh\Babelsheet\DataSaver\DataIntoFileSaver;
use Tsh\Babelsheet\DataSaver\DataSaver;

class DataSaverServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DataSaver::class, function () {
            return new DataIntoFileSaver(
                new ArrayToStringParser(),
                Storage::createLocalDriver([
                    'root' => base_path(),
                ])
            );
        });
    }
}
