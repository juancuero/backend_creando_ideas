<?php

namespace App\Jobs;

use App\Models\Audit;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SaveAuditToDBJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;
    protected $data;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string
     */
    public $queue = 'lowPriority';

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        Audit::create($this->data);
    }

    /**
     * Handle a job failure.
     *
     * @param Exception $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        error_log(json_encode($exception->getMessage()));

        Log::error('UNABLE TO SAVE AUDIT RECORD FROM JOB.', [
            'data' => $this->data,
            'errors' => json_encode($exception->getMessage()),
        ]);
    }
}
