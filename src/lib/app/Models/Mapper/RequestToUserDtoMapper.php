<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\UserDto;
use AutoMapperPlus\CustomMapper\CustomMapper;
use Illuminate\Http\Request;

/**
 * Class RequestToUserDtoMapper
 * @package App\Models\Mapper
 */
final class RequestToUserDtoMapper extends CustomMapper
{

    /**
     * @param Request $source
     * @param UserDto $destination
     * @return UserDto
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): UserDto
    {
        $destination->name = $source->name;
        $destination->surname = $source->surname;
        $destination->email = $source->email;
        $destination->password = $source->password;
        $destination->role = $source->role;

        return $destination;
    }
}
