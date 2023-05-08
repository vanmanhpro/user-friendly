<?php

namespace App\Console\Commands;

use App\Models\WettyEvents;
use App\Services\Docker;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class TestCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        WettyEvents::create([
            'ContainerID' => 'asdfasdf',
            'EventType' => 'Create'
        ]);

        return 0;
    }
}
