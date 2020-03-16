<?php

namespace EvolutionCMS\Main\Components\SnippetResult\exceptions;

use Throwable;

class Exception extends \Exception
{
    public function __construct(
        $message = "Component SnippetResult internal error!",
        $code = 500,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
