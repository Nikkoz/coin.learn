<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class RequestException extends Exception
{
    /**
     * Сообщение по умолчанию.
     *
     * @var string
     */
    protected $defaultMessage = 'Error sending request.';

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = $this->defaultMessage;
        }

        parent::__construct($message, $code, $previous);
    }
}