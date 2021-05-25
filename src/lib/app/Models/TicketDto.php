<?php
/**
 * TicketDto
 */

namespace App\Models;

/**
 * TicketDto
 */
class TicketDto
{

    /** @var string $uuid */
    public $uuid;

    /** @var string $title */
    public $title;

    /** @var string $description */
    public $description;

    /** @var string $lean */
    public $lean;

    /** @var int $priority */
    public $priority;

    /** @var string $assignedTo */
    public $assignedTo;

}
