<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\TicketDto;
use AutoMapperPlus\CustomMapper\CustomMapper;
use Illuminate\Http\Request;

/**
 * Class RequestToTicketDtoMapper
 * @package App\Models\Mapper
 */
final class RequestToTicketDtoMapper extends CustomMapper
{

    /**
     * @param Request $source
     * @param TicketDto $destination
     * @return TicketDto
     * @noinspection PhpUndefinedFieldInspection
     */
    public function mapToObject($source, $destination): TicketDto
    {
        $destination->title = $source->title;
        $destination->description = $source->description;
        $destination->lean = $source->lean;
        $destination->priority = $source->priority;
        $destination->assignedTo = $source->assignedTo;

        return $destination;
    }
}
