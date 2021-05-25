<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Lean;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LeanRepository
 * @package App\Repositories
 */
final class LeanRepository extends Repository
{

    /**
     * @param string $uuid
     * @return Model|null
     */
    public function find(string $uuid): ?Model
    {
        return Lean::withoutTrashed()->where('uuid', '=', $uuid)->first();
    }

    /**
     * @return Collection|null
     */
    public function findAll(): ?Collection
    {
        return Lean::withoutTrashed()->get();
    }
}
