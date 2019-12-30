<?php

declare(strict_types=1);

namespace Tsh\Babelsheet;

class ArrayToStringParser
{
    public function parse(array $data): string
    {
        return var_export($data, true);
    }
}
