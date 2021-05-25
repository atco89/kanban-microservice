<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Class ErrorDto
 * @package App\Models
 */
final class ErrorDto
{

    /**
     * @var string
     */
    public string $code;

    /**
     * @var string
     */
    public string $message;
}
