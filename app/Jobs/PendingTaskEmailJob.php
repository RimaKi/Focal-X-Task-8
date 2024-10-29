<?php

namespace App\Jobs;

use App\Mail\PendingTaskMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\IsEmpty;

class PendingTaskEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }


    /**
     *  Execute the job.
     * Send emails to people who have unfinished tasks.
     * @return void
     */
    public function handle(): void
    {
        $users = User::query()->withWhereHas('tasks',function ($q){
            return $q->where('status','pending');
        })->get();
        foreach ($users as $user){
            Mail::to($user->email)->send(new PendingTaskMail($user->name,$user->tasks));
        }
    }
}
