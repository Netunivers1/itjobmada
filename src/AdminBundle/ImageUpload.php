<?php

namespace AdminBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUpload
{
    private $targetDir ;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        if ( $file->guessExtension() == 'jpeg' || $file->guessExtension() == 'jpg'){
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getTargetDir(), $fileName);
            return $fileName;
        }
        return false ;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}
