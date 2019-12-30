<?php

declare(strict_types=1);

namespace Tsh\Babelsheet\Exceptions;

use Exception;
use Throwable;

class WrongFormatOfFetchedDataException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return 'Fetched data is not an array.';
    }
}
