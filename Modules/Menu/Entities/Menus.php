<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Core\Traits\SpatieLogsActivity;

class Menus extends Model
{

    use
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;
    // HasTranslations for add translate for any field
    // HasTranslations;

    protected $table = 'menus';

    protected $fillable = ['name', 'place'];

    // public $translatable = ['name']; // Columns to translate

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_menus');
    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany(MenuItems::class, 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }
}
