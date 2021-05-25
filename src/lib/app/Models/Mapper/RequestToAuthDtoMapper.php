<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\AuthDto;
use AutoMapperPlus\CustomMapper\CustomMapper;
use Illuminate\Http\Request;

/**
 * Class RequestToAuthDtoMapper
 * @package App\Models\Mapper
 */
final class RequestToAuthDtoMapper extends CustomMapper
{

    /**
     * @param Request $source
     * @param AuthDto $destination
     * @return AuthDto
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): AuthDto
    {
        $destination->email = $source->email;
        $destination->password = $source->password;
        return $destination;
    }
}
