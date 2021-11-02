<?php

namespace App\Jobs;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    private $config;
    private $position;
    private $file;
    private $isMainImage = false;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $model, UploadedFile $file, array $config, array $position, bool $isMainImage = false)
    {
        $this->model = $model;
        $this->file = $file;
        $this->config = $config;
        $this->position = $position;
        $this->isMainImage = $isMainImage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
