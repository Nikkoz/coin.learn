<?php

namespace App\Exceptions\File;

use Exception;
use Throwable;

/**
 * Исключение сохранения файла.
 */
class FailedFileSaveException extends Exception
{
    /**
     * Сообщение по умолчанию.
     *
     * @var string
     */
    protected $defaultMessage = 'Failed save file.';

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = $this->defaultMessage;
        }

        parent::__construct($message, $code, $previous);
    }
}

{

}