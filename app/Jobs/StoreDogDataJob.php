<?php

namespace App\Jobs;

use App\Helpers\Simulatable;
use Database\Factories\DogFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreDogDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Simulatable;

    public function __construct(protected array $dogData)
    {}

    public function handle(): void
    {
        $this->simulateLongProcess();

        DogFactory::new()
            ->createOne(
                ['data' => json_encode($this->dogData)]
            );
    }
}
