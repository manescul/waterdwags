<?php

namespace App\Helpers;

trait Simulatable
{
    protected function simulateLongProcess(): void
    {
        if ($secondsToSleep = env('SIMULATION__DB_LONG_PROCESS_TIME_IN_SECONDS')) {
            sleep($secondsToSleep);
        }
    }
}
