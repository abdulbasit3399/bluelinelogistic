<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LanguagesSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'languages:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add languages supported to database';

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
        if (check_module('localization')) {
            Artisan::call('db:seed', [
                'class' => "Modules\Localization\Database\Seeders\LanguagesTableSeeder"
            ]);
            $this->info('Languages Seeded');
        }
    }
}
