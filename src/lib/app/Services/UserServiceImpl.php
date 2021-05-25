<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\NotUniqueEmailException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Models\UserDto;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Exception\InvalidArgumentException;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Exception;

/**
 * Class UserServiceImpl
 * @package App\Services
 */
final class UserServiceImpl implements UserService
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
     * UserServiceImpl constructor.
     * @param AutoMapper $mapper
     * @param UserRepository $userRepository
     */
    public function __construct(AutoMapper $mapper, UserRepository $userRepository)
    {
        $this->mapper = $mapper;
        $this->repository = $userRepository;
    }

    /**
     * @param UserDto $userDto
     * @return UserDto
     * @throws NotUniqueEmailException
     * @throws UnregisteredMappingException
     */
    public function store(UserDto $userDto): UserDto
    {
        if ($this->repository->emailIsRegistered($userDto->email)) {
            throw new NotUniqueEmailException();
        }

        $user = $this->repository->store($this->mapper->map($userDto, User::class));
        return $this->mapper->map($user, UserDto::class);
    }

    /**
     * @return UserDto[]
     * @throws InvalidArgumentException
     */
    public function getAll(): array
    {
        return $this->mapper->mapMultiple($this->repository->findAll(), UserDto::class);
    }

    /**
     * @param string $uuid
     * @return UserDto
     * @throws UnregisteredMappingException
     * @throws UserNotFoundException
     */
    public function get(string $uuid): UserDto
    {
        $user = $this->repository->find($uuid);
        if (empty($user)) {
            throw new UserNotFoundException();
        }

        return $this->mapper->map($user, UserDto::class);
    }

    /**
     * @param string $uuid
     * @param UserDto $userDto
     * @return UserDto
     * @throws NotUniqueEmailException
     * @throws UnregisteredMappingException
     * @throws UserNotFoundException
     * @noinspection PhpUndefinedFieldInspection
     */
    public function modify(string $uuid, UserDto $userDto): UserDto
    {
        $user = $this->repository->find($uuid);
        if (empty($user)) {
            throw new UserNotFoundException();
        }

        $email = $userDto->email;
        if ($user->email !== $email && $this->repository->emailIsRegistered($email)) {
            throw new NotUniqueEmailException();
        }

        $user = $this->mapper->mapToObject($userDto, $user);
        return $this->mapper->mapToObject($this->repository->store($user), $userDto);
    }

    /**
     * @param string $uuid
     * @return bool
     * @throws UserNotFoundException
     * @throws Exception
     */
    public function delete(string $uuid): bool
    {
        $user = $this->repository->find($uuid);
        if (empty($user)) {
            throw new UserNotFoundException();
        }

        return $this->repository->softDelete($user);
    }

    /**
     * @param string|null $keyWords
     * @return UserDto[]
     * @throws InvalidArgumentException
     * @throws UserNotFoundException
     */
    public function search(?string $keyWords): array
    {
        $users = $this->repository->findByKeyWords($keyWords);
        if (empty($users)) {
            throw new UserNotFoundException();
        }

        return $this->mapper->mapMultiple($users, UserDto::class);
    }
}
