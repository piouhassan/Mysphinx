<?php


namespace Akuren\File;


class UploadConfig extends Upload
{

    protected  $path = 'uploads';

    protected  $formats =  [
        'thumb' => [450 , 280]
        ];

}