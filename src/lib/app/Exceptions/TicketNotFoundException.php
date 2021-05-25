<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class UserNotFoundException
 * @package App\Exceptions
 */
final class TicketNotFoundException extends Exception
{

    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct("Ticket not found.", 404);
    }
}
