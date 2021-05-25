<?php
declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\UserDto;

/**
 * Interface UserService
 * @package App\Services\Interfaces
 */
interface UserService
{

    /**
     * @param UserDto $userDto
     * @return UserDto
     */
    public function store(UserDto $userDto): UserDto;

    /**
     * @return UserDto[]
     */
    public function getAll(): array;

    /**
     * @param string $uuid
     * @return object
     */
    public function get(string $uuid): object;

    /**
     * @param string $uuid
     * @param UserDto $userDto
     * @return UserDto
     */
    public function modify(string $uuid, UserDto $userDto): UserDto;

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool;

    /**
     * @param string|null $keyWords
     * @return UserDto[]
     */
    public function search(?string $keyWords): array;
}
