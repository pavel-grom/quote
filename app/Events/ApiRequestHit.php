<?php

namespace App\Events;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;

class ApiRequestHit
{
    use Dispatchable;

    private User $user;
    private Carbon $date;

    public function __construct(User $user, Carbon $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }
}
