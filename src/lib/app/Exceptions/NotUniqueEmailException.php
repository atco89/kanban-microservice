<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class NotUniqueEmailException
 * @package App\Exceptions
 */
final class NotUniqueEmailException extends Exception
{

    /**
     * NotUniqueEmailException constructor.
     */
    public function __construct()
    {
        parent::__construct('Email already exists.', 400);
    }
}
