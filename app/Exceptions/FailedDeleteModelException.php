<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class FailedDeleteModelException extends Exception
{
    /**
     * Сообщение по умолчанию.
     *
     * @var string
     */
    protected $defaultMessage = 'Model not deleted. Please try again.';

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = $this->defaultMessage;
        }

        parent::__construct($message, $code, $previous);
    }
}