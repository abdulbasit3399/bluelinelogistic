<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Illuminate\Support\Facades\File;

class UpdateGoogleSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('google.google_map', false);
    }
}
