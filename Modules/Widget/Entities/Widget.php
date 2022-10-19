<?php

namespace Modules\Widget\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;
use App\Models\User;

class Widget extends Model
{
    use
    // SpatieLogsActivity for save log activity
    SpatieLogsActivity;

    protected $fillable = [
        'creator_id',
        'data',
        'widget',
        'sidebar_id',
        'theme',
        'sort'
    ];

    protected $casts = [
        'data' => 'array',
        'sort' => 'integer'
    ];


    protected static function booted()
    {
        // when creating widget
        static::creating(function ($widget) {
            $widget->creator_id = auth()->id();
        });
    }

    public function getViewAttribute()
    {
        $widget = $this->widget;
        $widget_class = new $widget();
        return $widget_class->view($this->id, $this->data)->render();
    }

    public function getFormAttribute()
    {
        $widget = $this->widget;
        $widget_class = new $widget();
        return $widget_class->form($this->data, $this->id)->render();
    }


    /* ========================================= Relations ========================================= */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

}
