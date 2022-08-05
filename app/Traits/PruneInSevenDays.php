<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Prunable;

trait PruneInSevenDays
{
    use Prunable;

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDays(7));
    }
}
