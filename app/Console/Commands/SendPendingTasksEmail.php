<?php

namespace App\Console\Commands;

use App\Jobs\PendingTaskEmailJob;
use Illuminate\Console\Command;

class SendPendingTasksEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-pending-tasks-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        PendingTaskEmailJob::dispatch();
    }
}
