<?php
declare(strict_types=1);

namespace App\Services\Interfaces;

use app\Models\TicketDto;

/**
 * Interface TicketService
 * @package App\Services\Interfaces
 */
interface TicketService
{

    /**
     * @param TicketDto $ticketDto
     * @return TicketDto
     */
    public function store(TicketDto $ticketDto): TicketDto;

    /**
     * @return TicketDto[]
     */
    public function getAll(): array;

    /**
     * @param string $uuid
     * @return TicketDto
     */
    public function get(string $uuid): TicketDto;

    /**
     * @param string $uuid
     * @return TicketDto[]
     */
    public function getHistory(string $uuid): array;

    /**
     * @param string $uuid
     * @param TicketDto $ticketDto
     * @return TicketDto
     */
    public function modify(string $uuid, TicketDto $ticketDto): TicketDto;

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool;

    /**
     * @param string|null $title
     * @return TicketDto[]
     */
    public function search(?string $title): array;
}
