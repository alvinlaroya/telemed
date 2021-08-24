<?php

namespace App\Helpers;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

// used in config/medialibrary
// for s3 because it doesnt create root folder for media uploads
// https://docs.spatie.be/laravel-medialibrary/v7/advanced-usage/using-a-custom-directory-structure/
class CustomPathGenerator implements PathGenerator
{
    protected $path;

    public function __construct()
    {
        $this->path = config('mediaLibrary.disk_name') == 'azure' ? '/' : '/uploads/';
    }

    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media).'/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    /*
     * Get a unique base path for the given media.
     */
    protected function getBasePath(Media $media): string
    {
        return $this->path . $media->getKey();
    }

}
