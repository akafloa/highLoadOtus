<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class CreateFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;


/**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->userId = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $uController = new UserController();
        $posts = $uController->createFeed($this->userId);
        
        cache([$this->userId . '.feed' => $posts], Carbon::now()->addMinutes(1));
        
        
        
        //info('User id ::'.$this->userId." : ". sizeof($posts));
        //info('chache ::'.$this->userId . '.feed'. " | ".sizeof($posts)." | ". Carbon::now()->addMinutes(1));
        //Cache::put('fjsdhf1', '123!!', Carbon::now()->addMinutes(1));
        //Cache::put('fjsdhf12__-', $this->userId.'', Carbon::now()->addMinutes(1));
        //Cache::put('feed'.$this->userId, $posts, Carbon::now()->addMinutes(1));
        //Cache::put($this->userId.'.feed', sizeof($posts), Carbon::now()->addMinutes(1));
        //Cache::put('feed'.$this->userId, $posts, Carbon::now()->addMinutes(1));
        //return $posts;
    }
}
