<?php

namespace App\Domains\Buildings\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    /**
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    public function upload(
        UploadedFile $file,
        string $path = ''
    ): string
    {
        return Storage::disk('public')->put($path, $file);
    }

    /**
     * @param string $path
     * @return bool|void
     */
    public function deleteFile(
        string $path
    )
    {
        if (Storage::disk('public')->exists($path))
        {
            return Storage::delete($path);
        }
    }
}
