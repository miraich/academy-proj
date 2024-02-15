<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface DownloadFileInterface
{
    public function download_file_by_url(?string $url, string $folder_name): bool;

    public function download_file_form(?UploadedFile $file, string $folder_name): void;

    public function get_ext(): ?string;


    public function set_ext(string $name): void;


    public function get_filename(): ?string;


    public function set_filename($name): void;

}
