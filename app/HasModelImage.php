<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/9/16
 * Time: 10:23 AM
 */

namespace App;


trait HasModelImage
{
    abstract public function defaultImageSrc();

    public function setImage($file)
    {
        $this->clearMediaCollection();

        return $this->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }

    public function imageSrc($conversion = '')
    {
        return $this->getFirstMediaUrl('default', $conversion) ? $this->getFirstMediaUrl('default', $conversion) : $this->defaultImageSrc();
    }
}