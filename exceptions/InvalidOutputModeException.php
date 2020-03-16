<?php

namespace Indeximstudio\SnippetResult\exceptions;

use Throwable;

class InvalidOutputModeException extends Exception
{
    public function __construct(
        $message = 'Invalid output mode!',
        $code = 449410,
        Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
