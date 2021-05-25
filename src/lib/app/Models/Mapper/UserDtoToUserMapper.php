<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\User;
use App\Models\UserDto;
use AutoMapperPlus\CustomMapper\CustomMapper;

/**
 * Class UserDtoToUserMapper
 * @package App\Models\Mapper
 */
final class UserDtoToUserMapper extends CustomMapper
{

    /**
     * @param UserDto $source
     * @param User $destination
     * @return User
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): User
    {
        $destination->name = $source->name;
        $destination->surname = $source->surname;
        $destination->email = $source->email;
        $destination->password = password_hash($source->password, PASSWORD_BCRYPT);
        $destination->role = $source->role;

        return $destination;
    }
}
