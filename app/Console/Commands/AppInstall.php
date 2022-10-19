<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App install';

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


        // Generate a new key for your app
        Artisan::call('key:generate');

        // Create the symbolic link
        Artisan::call('storage:link');

        // Create database
        Artisan::call('migrate');

        // create user demo
        Artisan::call('db:seed', [
            'class' => "Database\Seeders\UsersSeeder"
        ]);
        // Artisan::call('database:import');

        // Create languages
        Artisan::call('languages:seed');

        // Create translations
        Artisan::call('translations:sync');

        // Create permissions
        Artisan::call('permissions:sync');

        // Refresh cache
        Artisan::call('refresh:cache');

        // Seed all modules
        Artisan::call('module:seed');

        $user_demo = User::find(1);
        if ($user_demo) {
            $this->newLine();
            $this->info('App installed successfully.');
            $this->newLine();
            $this->line('User Login ->');
            $this->line('Email: admin@admin.com');
            $this->line('Password: 123456');
            $this->newLine();
            $this->line('Url: ' . url(env('PREFIX_ADMIN', 'admin')));
        } else {
            $this->newLine();
            $this->error('There was an error installing the application.');
        }

    }
}