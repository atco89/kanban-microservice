<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\Lean;
use App\Models\Ticket;
use App\Models\TicketDto;
use App\Models\User;
use AutoMapperPlus\CustomMapper\CustomMapper;

/**
 * Class TicketToTicketDtoMapper
 * @package App\Models\Mapper
 */
final class TicketToTicketDtoMapper extends CustomMapper
{

    /**
     * @param Ticket $source
     * @param TicketDto $destination
     * @return TicketDto
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): TicketDto
    {
        $destination->uuid = $source->uuid;
        $destination->title = $source->title;
        $destination->description = $source->description;
        $destination->lean = $this->loadLeanUuid($source->lean);
        $destination->priority = $source->priority;
        $destination->assignedTo = $this->loadAssignedToUuid($source->assignedTo);

        return $destination;
    }

    /**
     * @param Lean|null $lean
     * @return string|null
     * @noinspection PhpUndefinedFieldInspection
     */
    private function loadLeanUuid(?Lean $lean): ?string
    {
        return $lean instanceof Lean ? strval($lean->uuid) : null;
    }

    /**
     * @param User|null $user
     * @return string|null
     * @noinspection PhpUndefinedFieldInspection
     */
    private function loadAssignedToUuid(?User $user): ?string
    {
        return $user instanceof User ? strval($user->uuid) : null;
    }
}
