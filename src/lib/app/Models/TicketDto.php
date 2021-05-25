<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class TicketDto
 * @package App\Models
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
