<?php

namespace App\Core\Widget\Support;

interface WidgetInterface {
    
    /**
     * View form in admin page.
     *
     * @return View
     */
    public function form($oldData, $id);

    /**
     * View in frontend page (in sidebar).
     *
     * @return View
     */
    public function view($id, $data);

    /**
     * Maping data
     * map data for passing to validation and store or update method 
     * @param array $request
     * @return array
     */
    public function mapData($request, $id = null);

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
    public function store($request);

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
    public function update($widget, $request);


}