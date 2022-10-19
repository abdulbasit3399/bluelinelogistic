<?php

namespace App\Core\Widget\Template;

use App\Core\Widget\Support\WidgetInterface;

abstract class Widget implements WidgetInterface {


    /**
     * Visibility in widget list
     */
    public $title; // if *true* will be show in widget list in admin page

    /**
     * Visibility in widget list
     */
    public $publish; // if *true* will be show in widget list in admin page

    /**
     * widget id to save in database.
     */
    public $type; // Example:  heading, table, paragraph, gallery, ads, list, video

    /**
     * widget id to save in database.
     */
    public $group; // Example:  text, media

    /**
     * widget name to view in admin page.
     */
    public $name; // Example: Heading, Table, Paragraph, Gallery, Ads, List, Video

    /**
     * widget description to view in admin page.
     */
    public $description;


    public function __construct()
    {
        $this->title = is_array($this->name) ? (array_key_exists(config('app.locale'), $this->name) ? $this->name[config('app.locale')] : (array_key_exists(config('app.fallback_locale'), $this->name) ? $this->name[config('app.fallback_locale')] : $this->type)) : $this->name;
    }

    /**
     * View form in admin page.
     *
     * @return View
     */
    abstract public function form($oldData, $id = null);

    /**
     * View in frontend page (in sidebar).
     *
     * @return View
     */
    abstract public function view($id, $data);

    /**
     * Maping data
     * map data for passing to validation and store or update method 
     * @param array $request
     * @return array
     */
    abstract public function mapData($request, $id = null);

    /**
     * Handle creating data
     * 
     * Run this method when clicked on save when create new widget
     * here handle and map your data to save in database
     * examples: 
     * upload image.
     *
     * @param collection $widget -> old object data from database 
     * @param array $request -> form data
     * @return array
     */
    abstract public function store($request);

    /**
     * Handle update data
     * 
     * Run this method when clicked on save
     * here handle and map your data to save in database
     * examples: 
     * upload image.
     *
     * @param collection $widget -> old object data from database 
     * @param array $request -> form data
     * @return array
     */
    abstract public function update($widget, $request);

}