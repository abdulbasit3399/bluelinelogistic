<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Core\Traits\SpatieLogsActivity;

class MenuItems extends Model
{

    use
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;
    // HasTranslations for add translate for any field
    // HasTranslations;

    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id'];

    // public $translatable = ['label']; // Columns to translate

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_items');
    }


    public function getUrlAttribute()
    {
        $url = $this->link;
        if ($this->type == 'category') {
            $url = fr_route('category-page', ['slug' => $this->link]);
        } else if ($this->type == 'post') {
            $url = fr_route('post-page', ['slug' => $this->link]);
        } else if ($this->type == 'page') {
            $url = fr_route('page-page', ['slug' => $this->link]);
        }
        return $url;
    }


    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }
    public function getall($id)
    {
        return $this->where("menu", $id)->orderBy("sort", "asc")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu', $menu)->max('sort') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo(Menus::class, 'menu');
    }

    public function child()
    {
        return $this->hasMany(MenuItems::class, 'parent')->orderBy('sort', 'ASC');
    }
}
