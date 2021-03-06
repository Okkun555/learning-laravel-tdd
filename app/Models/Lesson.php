<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    public function getVacancyLevelAttribute(): VacancyLevel
    {
        return new VacancyLevel($this->remainingCount());
    }

    public function remainingCount(): int
    {
        $reservation = $this->reservations()->count();
        $remainingCount = $this->capacity - $reservation;

        return $remainingCount;
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
