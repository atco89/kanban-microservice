<?php
declare(strict_types=1);

namespace App\Models\Mapper;

use App\Models\ErrorDto;
use AutoMapperPlus\CustomMapper\CustomMapper;
use Exception;

/**
 * Class ExceptionToErrorDto
 * @package App\Models\Mapper
 */
final class ExceptionToErrorDto extends CustomMapper
{

    /**
     * @param Exception $source
     * @param ErrorDto $destination
     * @return ErrorDto
     */
    public function mapToObject($source, $destination): ErrorDto
    {
        $destination->code = strval($source->getCode());
        $destination->message = $source->getMessage();
        return $destination;
    }
}
