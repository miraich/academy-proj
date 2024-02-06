<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface DownloadFileInterface
{
    public function download_file_by_url(?string $url, string $folder_name): void;

    public function download_file_form(?UploadedFile $file, string $folder_name): void;
}
