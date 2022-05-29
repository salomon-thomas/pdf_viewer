<?php

namespace App\Traits;

trait SetTrait
{
    public function setAwsPath($filename)
    {
        return "http://127.0.0.1:8000/uploads" . $filename;
    }
}