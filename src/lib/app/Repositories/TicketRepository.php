<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketRepository
 * @package App\Repositories
 */
final class TicketRepository extends Repository
{

    /**
     * @param string $uuid
     * @return Model|null
     */
    public function find(string $uuid): ?Model
    {
        return Ticket::withoutTrashed()->where('uuid', '=', $uuid)->first();
    }

    /**
     * @return Collection|null
     */
    public function findAll(): ?Collection
    {
        return Ticket::withoutTrashed()->get();
    }

    /**
     * @param string $uuid
     * @return Collection|null
     */
    public function findHistory(string $uuid): ?Collection
    {
        return Ticket::withTrashed()->where('uuid', '=', $uuid)->get();
    }

    /**
     * @param string|null $title
     * @return Collection|null
     */
    public function findByTitle(?string $title): ?Collection
    {
        if (empty($title)) {
            return null;
        }

        return Ticket::withoutTrashed()->where('title', 'like', '%' . $title . '%')->get();
    }
}
