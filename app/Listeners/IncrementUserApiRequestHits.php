<?php

namespace App\Listeners;

use App\Events\ApiRequestHit;
use Illuminate\Support\Facades\Cache;

class IncrementUserApiRequestHits
{
    public function handle(ApiRequestHit $event): void
    {
        Cache::increment("api:users:{$event->getUser()->id}");
    }
}
