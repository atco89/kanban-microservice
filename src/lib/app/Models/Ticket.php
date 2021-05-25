<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Ticket
 * @package App\Models
 */
final class Ticket extends BaseModel
{

    /**
     * @return HasOne
     */
    public function lean(): HasOne
    {
        return $this->hasOne(Lean::class, 'id', 'lean_id');
    }

    /**
     * @return HasOne
     */
    public function assignedTo(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }
}
