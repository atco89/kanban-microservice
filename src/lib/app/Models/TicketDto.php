<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class TicketDto
 * @package App\Models
 */
final class TicketDto
{

    /**
     * @var string
     */
    public string $uuid;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $description;

    /**
     * @var string|null
     */
    public ?string $lean;

    /**
     * @var int
     */
    public int $priority;

    /**
     * @var string|null
     */
    public ?string $assignedTo;

}
