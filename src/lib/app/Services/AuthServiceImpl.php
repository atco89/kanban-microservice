<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\AuthDto;
use App\Models\UserDto;
use App\Repositories\UserRepository;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Exception\UnregisteredMappingException;

/**
 * Class AuthServiceImpl
 * @package App\Services
 */
final class AuthServiceImpl implements Interfaces\AuthService
{

    /**
     * @var AutoMapper
     */
    private AutoMapper $mapper;

    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * AuthServiceImpl constructor.
     * @param AutoMapper $mapper
     * @param UserRepository $repository
     */
    public function __construct(AutoMapper $mapper, UserRepository $repository)
    {
        $this->mapper = $mapper;
        $this->repository = $repository;
    }

    /**
     * @param AuthDto $authDto
     * @return UserDto
     * @throws UnregisteredMappingException
     * @throws UserNotFoundException
     * @noinspection PhpUndefinedFieldInspection
     */
    public function signIn(AuthDto $authDto): UserDto
    {
        $user = $this->repository->findByEmail($authDto->email);
        if (empty($user) || !password_verify($authDto->password, $user->password)) {
            throw new UserNotFoundException();
        }
        return $this->mapper->map($user, UserDto::class);
    }
}
