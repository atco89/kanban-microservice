<?php
declare(strict_types=1);

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 * @package App\Repositories
 */
abstract class Repository
{

    /**
     * @param string $uuid
     * @return Model|null
     */
    abstract public function find(string $uuid): ?Model;

    /**
     * @return Collection|null
     */
    abstract public function findAll(): ?Collection;

    /**
     * @param Model $model
     * @return Model|null
     */
    final public function store(Model $model): ?Model
    {
        return $model->save() ? $model : null;
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws Exception
     */
    final public function softDelete(Model $model): ?bool
    {
        return $model->delete();
    }
}
