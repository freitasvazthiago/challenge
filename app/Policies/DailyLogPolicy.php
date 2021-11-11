<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class DailyLogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, DailyLog $dailyLog)
    {
        return $user->id == $dailyLog->user_id;
    }
}
