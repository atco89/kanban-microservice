<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\User;
use App\Models\UserDto;
use AutoMapperPlus\CustomMapper\CustomMapper;

/**
 * Class UserToUserDTO
 * @package App\Models\Mapper
 */
final class UserToUserDtoMapper extends CustomMapper
{

    /**
     * @param User $source
     * @param UserDto $destination
     * @return User
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): UserDto
    {
        $destination->uuid = $source->uuid;
        $destination->name = $source->name;
        $destination->surname = $source->surname;
        $destination->email = $source->email;
        $destination->password = $source->password;
        $destination->role = $source->role;

        return $destination;
    }
}
