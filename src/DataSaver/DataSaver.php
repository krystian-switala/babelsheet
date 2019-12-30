<?php

namespace Tsh\Babelsheet\DataSaver;

interface DataSaver
{
    public function save(array $translations): bool;
}