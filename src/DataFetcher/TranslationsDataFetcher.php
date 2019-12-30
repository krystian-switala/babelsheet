<?php

namespace Tsh\Babelsheet\DataFetcher;

interface TranslationsDataFetcher
{
    public function fetchTranslation(): array;
}
