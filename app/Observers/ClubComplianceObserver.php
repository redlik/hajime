<?php

namespace App\Observers;

use App\Models\Club;
use Illuminate\Database\Eloquent\Model;

/**
 * Recalculates the club compliance indicator whenever a person linked to a
 * club (personnel, coach, volunteer) is added, changed, moved or removed.
 */
class ClubComplianceObserver
{
    public function saved(Model $model): void
    {
        $this->recalculate($model->club_id);

        if ($model->wasChanged('club_id')) {
            $this->recalculate($model->getOriginal('club_id'));
        }
    }

    public function deleted(Model $model): void
    {
        $this->recalculate($model->club_id);
    }

    private function recalculate($clubId): void
    {
        if ($clubId && $club = Club::find($clubId)) {
            $club->recalculateCompliance();
        }
    }
}
