<?php

namespace App\Helpers\HelperTraits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


/**
 * Use this trait when upload file or image
 */
trait FileHelper {

    /**
     * images of any file to validation extinsion.
     * 
     * @var array
     */
    private $allowed_extinsions = ['jpg', 'png', 'jpeg'];

    /**
     * images extinsions only -> use this to check on file when upload if ext not exists in this array will be uplaod file not image.
     *
     * @var array
     */
    private $image_extinsions = ['jpg', 'png', 'jpeg', 'gif'];

    /**
     * The upload file instance.
     *
     * @var Illuminate\Http\UploadedFile
     */
    private $uploaded_file = null;

    /**
     * The default image width .
     *
     * @var int
     */
    private $file_helper_default_width_image = 1024;

    /**
     * The default image height .
     *
     * @var int
     */
    private $file_helper_default_height_image = 768;

    /**
     * The width image when saving.
     *
     * @var int
     */
    public $file_helper_width_image = null;

    /**
     * The hieght image when saving.
     *
     * @var int
     */
    public $file_helper_height_image = null;

    /**
     * The quality image when saving.
     *
     * @var int
     */
    public $file_helper_quality_image = 80;

    /**
     * The aspect ratio when saving.
     *
     * @var boolean
     */
    public $file_helper_aspect_ratio = true;

	/**
	 * Convert base64 to file 
	 * @param UploadedFile $file -> file or base64
	 * @return Illuminate\Http\UploadedFile
	 */
	public function convertBase64ToFile($file)
    {
        if (!is_null($this->uploaded_file) && $this->uploaded_file instanceof UploadedFile) {
            return $this->uploaded_file;
        }
        if ($file instanceof UploadedFile) {
            return $file;
        } else if (gettype($file) == 'string') {
            return convert_base64_to_file($file);
        }
	}

	/**
	 * Generate file random name
	 * @param UploadedFile $file
	 * @param string $thumb Optional -> to add thumb in file name
	 * @return string
	 */
	public function fileGenerateName($file, $thumb = '')
    {
        $file       = $this->convertBase64ToFile($file);
        $extension  = $file->extension();
        $name       = pathinfo(Str::slug(strip_tags($file->getClientOriginalName())), PATHINFO_FILENAME);
        $date       = date('Y-m-d_H-i-s');
        $str_random = rand(100000, 999999); // 6 numbers
        $file_name = "{$date}_{$name}_{$str_random}";
        $file_name_original = "{$file_name}.{$extension}";
        $file_name_thumb    = "{$thumb}_{$file_name}.{$extension}";
        $result = [
            'original_name' => $file_name_original,
            'thumb_name' => $file_name_thumb
        ];
        return ($thumb != '' ? $result : $file_name_original);
	}

    /**
	* Check if allowed file extensions
	* @param UploadedFile-base64 $file
	* @param array $extensions Optional
	* @return boolean
	*/
	public function fileIsAllowedExtensions($file, $extensions = null)
    {
        $file       = $this->convertBase64ToFile($file);
		$extensions = $extensions ?? $this->allowed_extinsions;
		if(!in_array($file->extension(), $extensions)) {
			return false;
		}
        return true;
	}

    /**
	 * Upload file or image.
	 * @param UploadedFile||string->base64 $file
	 * @param string $path
	 * @param string $folder
	 * @return string file path after saved.
	 */
    public function fileUpload($file, $path, $folder = null)
    {
        $file       = $this->convertBase64ToFile($file);
        $path       = $this->getFilePath($path, $folder);
        $ext        = $file->extension();
        if(in_array($ext, $this->image_extinsions)) {
            list($width, $height) = getimagesize($file);
            $makeImage = Image::make($file);
            if ($width > $this->file_helper_default_width_image && $this->file_helper_width_image == null) {
                $makeImage->resize($this->file_helper_default_width_image, $this->file_helper_height_image, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                if ($this->file_helper_width_image != null) {
                    if (($this->file_helper_height_image != null && $width >= $height) || $this->file_helper_height_image == null) {
                        $this->file_helper_height_image = $this->file_helper_aspect_ratio ? null : $this->file_helper_height_image;
                        $makeImage->resize($this->file_helper_width_image, $this->file_helper_height_image, function ($constraint) {
                            if ($this->file_helper_aspect_ratio) {
                                $constraint->aspectRatio();
                            }
                        });
                    }
                }
            }
            if (($height > $this->file_helper_default_height_image && $width < $this->file_helper_default_width_image) && $this->file_helper_height_image == null) {
                $makeImage->resize($this->file_helper_width_image, $this->file_helper_default_height_image, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                if ($this->file_helper_height_image != null) {
                    if (($this->file_helper_width_image != null && $height >= $width) || $this->file_helper_width_image == null) {
                        $this->file_helper_width_image = $this->file_helper_aspect_ratio ? null : $this->file_helper_width_image;
                        $makeImage->resize($this->file_helper_width_image, $this->file_helper_height_image, function ($constraint) {
                            if ($this->file_helper_aspect_ratio) {
                                $constraint->aspectRatio();
                            }
                        });
                    }
                }
            }
            $fileStream = $makeImage->stream($ext, $this->file_helper_quality_image)->__toString();
            Storage::put($path, $fileStream);
        } else {
            Storage::put($path, fopen($file, 'r+'));
        }
        $this->fileResetProperties();
        return $path;
    }

    /**
	 * Convert file name to storage url file.
	 * @param string $file_name
	 * @param string $folder
	 * @return string storage url file
	 */
	public function getFileURL($file_name, $folder = null) {
        if ($folder) {
            $folder = Str::finish($folder, '/');
            $file_name = Str::start($file_name, '/');
            $file_name = substr($file_name, 1);
            $file_name = $folder . $file_name;
        }
		return Storage::url($file_name);
	}

    /**
	 * Convert file name to file path.
	 * @param string $file_name
	 * @param string $folder
	 * @return string file path
	 */
	public function getFilePath($file_name, $folder = null) {
        if ($folder) {
            $folder = Str::finish($folder, '/');
            $file_name = Str::start($file_name, '/');
            $file_name = substr($file_name, 1);
            $file_name = $folder . $file_name;
        }
		return $file_name;
	}


	/**
	 * Delete file.
	 * @param string $path
	 * @param stirng $folder
	 * @return boolean
	 */
	public function deleteFile($path, $folder = null) {
        $path = $this->getFilePath($path, $folder);
        return Storage::delete($path);
	}


    /**
	 * Reset class properties.
	 * @return void
	 */
    public function fileResetProperties()
    {
        $this->file_helper_width_image = null;
        $this->file_helper_height_image = null;
        $this->file_helper_quality_image = 70;
        $this->file_helper_aspect_ratio = false;
    }


    /**
	 * Change image width.
     *
     * @param int $width
	 * @return FileHelper
	 */
    public function width(int $width)
    {
        $this->file_helper_width_image = $width;
        return $this;
    }

    /**
	 * Change image height.
     *
     * @param int $height
	 * @return FileHelper
	 */
    public function height(int $height)
    {
        $this->file_helper_height_image = $height;
        return $this;
    }


    /**
	 * Change quality.
     *
     * @param int $quality
	 * @return FileHelper
	 */
    public function quality(int $quality)
    {
        $this->file_helper_quality_image = $quality;
        return $this;
    }

    /**
	 * Change aspect ratio.
     * 
     * @param bool $aspect_ratio
	 * @return FileHelper
	 */
    public function aspectRatio(bool $aspect_ratio)
    {
        $this->file_helper_aspect_ratio = $aspect_ratio;
        return $this;
    }




}


