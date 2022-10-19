<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Localization\Entities\Translation;

class TranslationsSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:sync {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add all translation words to database';

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
            $force = $this->option('force');
            if ($force) {
                Translation::truncate(); // delete all translations
            }
            Artisan::call('languages:seed');
            Artisan::call('db:seed', [
                'class' => "Modules\Localization\Database\Seeders\TranslationsTableSeeder"
            ]);
            $this->info('Translation Words Seeded to database');
        }
    }
}
