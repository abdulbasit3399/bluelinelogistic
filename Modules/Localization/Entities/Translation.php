<?php

namespace Modules\Localization\Entities;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Translation extends Model
{
    use Cachable, HasTranslations;
    
    protected $cachePrefix = "translations";

    public $fillable = [
        'key',
        'phrase',
        'is_rtl',
    ];

    protected $casts = [
        'is_rtl' => 'boolean'
    ];

    public $translatable = ['phrase']; // Columns to translate


    public function getNameAttribute()
    {
        $word_key = $this->key;
        $key_in_module = strpos($word_key, '::') != -1 ? true : false;
        $index_cuting = $key_in_module ? 1 : 0;
        $word_key_arr = array_slice(explode('.', $word_key), $index_cuting);
        $word_key_sluged = collect($word_key_arr)->map(function ($value) {
            return Str::replace('-', ' ', Str::slug($value));
        })->implode(' - ');
        $name = Str::title($word_key_sluged);
        return $name;
    }
}
