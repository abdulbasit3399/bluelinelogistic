<?php

namespace App\Core\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


/**
 * Summary.
 * Use this trait on a model you want to add a log activity
 *
 * @see App\Models\User relied on
 * @return LogsActivity.
 */
trait SpatieLogsActivity
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $logOptions = new LogOptions;
        $logOptions->logAll();
        $logOptions->logOnlyDirty();

        return $logOptions;
    }
}
