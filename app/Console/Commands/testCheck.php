<?php

namespace App\Console\Commands;

use CommerceGuys\Addressing\Subdivision\SubdivisionRepository;
use Galahad\LaravelAddressing\Support\Facades\Addressing;
use Illuminate\Console\Command;

class testCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'btgroup:testCheck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $country = new SubdivisionRepository();
        $ok = $country->getAll(['US']);

        dd($ok);
        return 0;
    }
}
