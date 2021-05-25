<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepository
 * @package App\Repositories
 */
final class UserRepository extends Repository
{

    /**
     * @param string $uuid
     * @return Model|null
     */
    public function find(string $uuid): ?Model
    {
        return User::withoutTrashed()->where('uuid', '=', $uuid)->first();
    }

    /**
     * @return Collection|null
     */
    public function findAll(): ?Collection
    {
        return User::withoutTrashed()->get();
    }

    /**
     * @param string|null $keyWords
     * @return Collection|null
     */
    public function findByKeyWords(?string $keyWords): ?Collection
    {
        if (empty($keyWords)) {
            return null;
        }

        return User::withoutTrashed()->where('name', 'like', '%' . $keyWords . '%')
            ->orWhere('surname', 'like', '%' . $keyWords . '%')->get();
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): ?Model
    {
        return User::withoutTrashed()->where('email', '=', $email)->first();
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailIsRegistered(string $email): bool
    {
        $user = User::withTrashed()->where('email', '=', $email)->first();
        return $user instanceof User;
    }
}
