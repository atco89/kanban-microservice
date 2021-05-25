<?php
declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\AuthDto;
use App\Models\UserDto;

/**
 * Interface AuthService
 * @package App\Services\Interfaces
 */
interface AuthService
{

    /**
     * @param AuthDto $authDto
     * @return UserDto
     */
    public function signIn(AuthDto $authDto): UserDto;
}
