<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lesson;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    public function reserve(User $user, Lesson $lesson): bool
    {
        try {
            $user->canReserve($lesson);
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::debug($e);
            return false;
        }
        return true;
    }
}
