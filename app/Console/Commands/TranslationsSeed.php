<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Localization\Entities\Translation;

class TranslationsSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add all translation words from seeder to database';

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
            Artisan::call('translations:sync'); // sync to database
            Artisan::call('translations:import'); // get all from database
            Translation::truncate(); // delete all translations
            Artisan::call('db:seed', [ // add all translations with updated
                'class' => "Database\Seeders\TranslationsTableSeeder"
            ]);
            $this->info('Translation Words Seeded');
        }
    }
}
