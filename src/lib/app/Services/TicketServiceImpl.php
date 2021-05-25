<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\TicketNotFoundException;
use App\Models\Ticket;
use App\Models\TicketDto;
use App\Repositories\TicketRepository;
use App\Services\Interfaces\TicketService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Exception\InvalidArgumentException;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class TicketServiceImpl
 * @package App\Services
 */
final class TicketServiceImpl implements TicketService
{

    /**
     * @var AutoMapper
     */
    private AutoMapper $mapper;

    /**
     * @var TicketRepository
     */
    private TicketRepository $repository;

    /**
     * TicketServiceImpl constructor.
     * @param AutoMapper $mapper
     * @param TicketRepository $ticketRepository
     */
    public function __construct(AutoMapper $mapper, TicketRepository $ticketRepository)
    {
        $this->mapper = $mapper;
        $this->repository = $ticketRepository;
    }

    /**
     * @param TicketDto $ticketDto
     * @return TicketDto
     * @throws UnregisteredMappingException
     */
    public function store(TicketDto $ticketDto): TicketDto
    {
        $ticket = $this->repository->store($this->mapper->map($ticketDto, Ticket::class));
        return $this->mapper->map($ticket, TicketDto::class);
    }

    /**
     * @return TicketDto[]
     * @throws InvalidArgumentException
     */
    public function getAll(): array
    {
        $tickets = $this->repository->findAll();
        return $this->mapper->mapMultiple($tickets, TicketDto::class);
    }

    /**
     * @param string $uuid
     * @return TicketDto
     * @throws TicketNotFoundException
     * @throws UnregisteredMappingException
     */
    public function get(string $uuid): TicketDto
    {
        $ticket = $this->repository->find($uuid);
        if (empty($ticket)) {
            throw new TicketNotFoundException();
        }

        return $this->mapper->map($ticket, TicketDto::class);
    }

    /**
     * @param string $uuid
     * @return TicketDto[]
     * @throws InvalidArgumentException
     * @throws TicketNotFoundException
     */
    public function getHistory(string $uuid): array
    {
        $tickets = $this->repository->findHistory($uuid);
        if (empty($tickets)) {
            throw new TicketNotFoundException();
        }

        return $this->mapper->mapMultiple($tickets, TicketDto::class);
    }

    /**
     * @param string $uuid
     * @param TicketDto $ticketDto
     * @return TicketDto
     * @throws TicketNotFoundException
     * @throws UnregisteredMappingException
     */
    public function modify(string $uuid, TicketDto $ticketDto): TicketDto
    {
        $ticket = $this->repository->find($uuid);
        if (empty($ticket)) {
            throw new TicketNotFoundException();
        }

        /** @var Ticket $ticket */
        $ticket = $this->mapper->mapToObject($ticketDto, $ticket);
        DB::transaction(function () use (&$ticket): void {
            $replicatedTicket = $ticket->replicate();
            $this->repository->softDelete($ticket);
            $ticket = $this->repository->store($replicatedTicket);
        });
        return $this->mapper->map($ticket, TicketDto::class);
    }

    /**
     * @param string $uuid
     * @return bool
     * @throws TicketNotFoundException
     * @throws Exception
     */
    public function delete(string $uuid): bool
    {
        $ticket = $this->repository->find($uuid);
        if (empty($ticket)) {
            throw new TicketNotFoundException();
        }

        return $this->repository->softDelete($ticket);
    }

    /**
     * @param string|null $title
     * @return TicketDto[]
     * @throws InvalidArgumentException
     * @throws TicketNotFoundException
     */
    public function search(?string $title): array
    {
        $tickets = $this->repository->findByTitle($title);
        if (empty($tickets)) {
            throw new TicketNotFoundException();
        }

        return $this->mapper->mapMultiple($tickets, TicketDto::class);
    }
}
