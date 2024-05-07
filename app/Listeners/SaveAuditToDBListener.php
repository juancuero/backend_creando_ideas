<?php

namespace App\Listeners;

use App\Jobs\SaveAuditToDBJob;
use OwenIt\Auditing\Events\Auditing;

class SaveAuditToDBListener
{
    /**
     * Handle the event.
     *
     * @param Auditing $event
     * @return bool
     * @throws \OwenIt\Auditing\Exceptions\AuditingException
     */
    public function handle(Auditing $event)
    {
        SaveAuditToDBJob::dispatch($event->model->toAudit());

        return false;
    }
}
