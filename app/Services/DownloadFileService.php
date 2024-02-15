<?php

namespace App\Services;

use App\Interfaces\DownloadFileInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DownloadFileService implements DownloadFileInterface
{
    private ?string $name;
    private ?string $ext;

    public function get_ext(): ?string
    {
        return $this->ext;
    }

    public function set_ext(string $name): void
    {
        $this->ext = $name;
    }

    public function get_filename(): ?string
    {
        return $this->name;
    }

    public function set_filename($name): void
    {
        $this->name = $name;
    }

    public function download_file_by_url(?string $url, string $folder_name): bool
    {
        if (isset($url)) {
            $file = file_get_contents($url);
            if ($file !== false) {
                $this->set_filename(md5(time()));
                $this->set_ext(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));

                return Storage::put("/" . $folder_name . "/" . $this->get_filename() . "." . $this->get_ext(), $file);
            }

        }
        return false;
    }

    public function download_file_form(?UploadedFile $file, string $folder_name): void
    {
        if (isset($file)) {
            Storage::put($folder_name, $file);
            $this->set_filename($file->hashName());
        }
    }
}

