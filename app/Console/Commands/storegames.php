<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use Session;

class storegames extends Command
{
    /**
        
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storegames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Check s'il y a de nouvelles games en équipe et les store!";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}