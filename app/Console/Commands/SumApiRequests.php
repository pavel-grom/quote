<?php

namespace App\Console\Commands;

use App\Jobs\SumApiRequestsJob;
use Illuminate\Console\Command;

class SumApiRequests extends Command
{
    protected $signature = 'api:requests:sum';

    protected $description = 'Command description';

    public function handle()
    {
        dispatch(new SumApiRequestsJob());
    }
}
