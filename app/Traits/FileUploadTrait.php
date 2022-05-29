<?php

namespace App\Traits;


use Exception;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    public function deleteFromS3($filename)
    {
        try {
            Storage::disk('public_uploads')->delete($filename);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function upload($file, $prefix, $path)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $prefix . time() . '.' . $extension;
        // Storage::disk('s3')->put($path . $filename, file_get_contents($file), 'public');
        Storage::disk('public_uploads')->put($path . $filename, file_get_contents($file));
        return $path . $filename;
    }
}
