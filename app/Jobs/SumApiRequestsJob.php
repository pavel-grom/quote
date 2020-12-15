<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class SumApiRequestsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $keys = Redis::connection('cache')
            ->client()
            ->keys("*:api:users:*");

        $sum = 0;

        foreach ($keys as $key) {
            $cacheKey = $this->getCacheKey($key);

            if (!$cacheKey) {
                continue;
            }

            $count = Cache::get($cacheKey);

            $sum += $count;
        }

        Cache::put('api-total-requests', $sum);
    }

    private function getCacheKey(string $key): ?string
    {
        $segments = explode(':', $key);

        $lastThreeSegments = array_slice($segments, -3);

        if (!$lastThreeSegments) {
            return null;
        }

        return implode(':', $lastThreeSegments);
    }
}
