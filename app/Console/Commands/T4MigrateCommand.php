<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class T4MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't4:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate all project Databases';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Running migrate --seed --no-interaction');
        Artisan::call('migrate:fresh --seed --no-interaction');
//        Artisan::call('migrate --seed --no-interaction');
        // Artisan::call('migrate:reset --path=database/migrations/rethinkdb');

//        $this->comment('Running migrate --seed');
//        Artisan::call('migrate --seed');

        // Artisan::call('migrate --path=database/migrations/rethinkdb');

        $this->info('Migration has been completed.');
    }
}
