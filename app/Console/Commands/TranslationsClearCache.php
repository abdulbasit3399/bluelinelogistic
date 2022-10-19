<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Localization\Entities\Translation;

class TranslationsClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cache for translations table';

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
            Artisan::call('modelCache:clear --model=Modules\\\Localization\\\Entities\\\Translation');
            $this->info("Cache for model 'Modules\Localization\Entities\Translation' has been flushed.");
        }
    }
}
