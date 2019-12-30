<?php

namespace Tsh\Babelsheet;

use Tsh\Babelsheet\DataFetcher\TranslationsDataFetcher;
use Tsh\Babelsheet\DataSaver\DataSaver;

class Babelsheet
{
    private $dataFetcher;
    private $dataSaver;
    private $data;

    public function __construct(TranslationsDataFetcher $dataFetcher, DataSaver $dataSaver)
    {
        $this->dataFetcher = $dataFetcher;
        $this->dataSaver = $dataSaver;
    }

    public function fetchData(): void
    {
        $this->data = $this->dataFetcher->fetchTranslation();
    }

    public function saveData(): void
    {
        $this->dataSaver->save($this->data);
    }
}
