<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class UserDto
 * @package App\Models
 */
final class UserDto
{

    /** @var string $uuid */
    public $uuid;

    /** @var string $name */
    public $name;

    /** @var string $surname */
    public $surname;

    /** @var string $email */
    public $email;

    /** @var string $password */
    public $password;

    /** @var string $role */
    public $role;

}
