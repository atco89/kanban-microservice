<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class UserNotFoundException
 * @package App\Exceptions
 */
final class UserNotFoundException extends Exception
{

    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct("User not found.", 404);
    }
}
