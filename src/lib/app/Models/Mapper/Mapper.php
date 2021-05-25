<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\ErrorDto;
use App\Models\Ticket;
use App\Models\TicketDto;
use App\Models\User;
use App\Models\UserDto;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Exception;
use Illuminate\Http\Request;

/**
 * Class Mapper
 * @package App\Models\Mapper
 */
final class Mapper
{

    /**
     * @return AutoMapper
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    public function load(): AutoMapper
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(Request::class, UserDto::class)
            ->useCustomMapper(new RequestToUserDtoMapper());

        $config->registerMapping(UserDto::class, User::class)
            ->useCustomMapper(new UserDtoToUserMapper());

        $config->registerMapping(User::class, UserDto::class)
            ->useCustomMapper(new UserToUserDtoMapper());

        $config->registerMapping(Request::class, TicketDto::class)
            ->useCustomMapper(new RequestToTicketDtoMapper());

        $config->registerMapping(TicketDto::class, Ticket::class)
            ->useCustomMapper(new TicketDtoToTicketMapper());

        $config->registerMapping(Ticket::class, TicketDto::class)
            ->useCustomMapper(new TicketToTicketDtoMapper());

        $config->registerMapping(Exception::class, ErrorDto::class)
            ->useCustomMapper(new ExceptionToErrorDto());

        return new AutoMapper($config);
    }
}
