<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DailyLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SaveRandomQuote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $date;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = Http::get('https://api.quotable.io/random');
        $content = $request->json()['content'];

        DailyLog::create(
            [
              'log' => $content,
              'user_id' => $this->user->id,
              'day' => $this->date
            ]
        );

        Log::info('SaveRandomQuote job is running!!! 🧨');
    }
}
