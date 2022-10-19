<?php

namespace App\Helpers\HelperClasses;
use App\Helpers\HelperTraits\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Class helper upload to easy upload in controller.
 */
class FileHelperClass {

    use FileHelper;

    private $request;

    private $field_name = 'image';
    private $field_name_remove = 'image_remove';
    private $field_name_remove_changed = false;
    private $dir;
    private $model = NULL;


    public function __construct($request = null)
    {
        $this->request = $request ?? request();
    }


    /**
     * Change field name.
     * 
     * @param string $name
     * @return FileHelperClass
     */
    public function fieldName(string $name)
    {
        $this->field_name = $name;
        return $this;
    }

    /**
     * Change field name remove.
     * 
     * @param string $name
     * @return FileHelperClass
     */
    public function fieldNameRemove(string $name)
    {
        $this->field_name_remove = $name;
        $this->field_name_remove_changed = true;
        return $this;
    }

    /**
     * Add direction path.
     * 
     * @param string $path
     * @return FileHelperClass
     */
    public function path(string $path)
    {
        $this->dir = $path;
        return $this;
    }

    /**
     * Add model.
     * 
     * @param Model $model
     * @return FileHelperClass
     */
    public function model($model)
    {
        $this->model = $model;
        return $this;
    }



    /**
     * Upload single file.
     * 
     * @return string file name.
     */
    public function singleUpload()
    {
        $field_name = $this->field_name;
        $field_name_remove = $this->field_name_remove_changed ? $this->field_name_remove : $field_name . '_remove';
        $request = $this->request;
        $file = $request->file($field_name);
        if (!$file instanceof UploadedFile) {
            $file = $this->convertBase64ToFile($request->get($field_name));
        }
        $file_remove = $request->get($field_name_remove);
        $model_file = $this->model ? (isset($this->model[$field_name]) ? $this->model[$field_name] : null) : null;
        $file_name = $model_file;

        // check on logo if removed from company will be deleted logo from file
        if ($this->model && $file_remove && $file_remove == 1) {
            if ($model_file && $model_file != null) {
                $this->deleteFile($model_file, $this->dir);
                $file_name = null;
            }
        }

        if ($file) {
            if ($this->model && $model_file && $model_file != null) {
                $this->deleteFile($model_file, $this->dir);
                $file_name = null;
            }
            $file_name = $this->fileGenerateName($file);
            $this->fileUpload($file, $file_name, $this->dir);
        }
        return $file_name;
    }
    
}