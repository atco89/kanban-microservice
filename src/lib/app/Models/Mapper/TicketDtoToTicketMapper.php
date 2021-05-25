<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\Lean;
use App\Models\Ticket;
use App\Models\TicketDto;
use App\Models\User;
use App\Repositories\LeanRepository;
use App\Repositories\UserRepository;
use AutoMapperPlus\CustomMapper\CustomMapper;

/**
 * Class TicketDtoToTicketMapper
 * @package App\Models\Mapper
 */
final class TicketDtoToTicketMapper extends CustomMapper
{

    /**
     * @param TicketDto $source
     * @param Ticket $destination
     * @return Ticket
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): Ticket
    {
        $destination->title = $source->title;
        $destination->description = $source->description;
        $destination->lean_id = $this->loadLeanId($source->lean);
        $destination->priority = $source->priority;
        $destination->assigned_to = $this->loadAssignedToId($source->assignedTo);

        return $destination;
    }

    /**
     * @param string|null $uuid
     * @return int|null
     * @noinspection PhpUndefinedFieldInspection
     */
    private function loadLeanId(?string $uuid): ?int
    {
        $leanRepository = new LeanRepository();
        $lean = $leanRepository->find($uuid);
        return $lean instanceof Lean ? intval($lean->id) : null;
    }

    /**
     * @param string|null $uuid
     * @return int|null
     */
    private function loadAssignedToId(?string $uuid): ?int
    {
        $userRepository = new UserRepository();
        $user = $userRepository->find($uuid);
        return $user instanceof User ? intval($user->id) : null;
    }
}
