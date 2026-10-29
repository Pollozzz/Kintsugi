<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\ImageDriver;
use Spatie\Image\Enums\Unit;
use Spatie\Image\Image;

class ResizeImage implements ShouldQueue
{
    use Queueable;

    private $w;

    private $h;

    private $fileName;

    private $path;

    public function __construct($filePath, $w, $h)
    {
        $this->fileName = basename($filePath);
        $this->path = dirname($filePath);
        $this->w = $w;
        $this->h = $h;

    }

    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;
        $srcPath = storage_path().'/app/public/'.$this->path.'/'.$this->fileName;
        $destPath = storage_path().'/app/public/'.$this->path."/crop_{$w}x{$h}_".
        $this->fileName;

        Image::useImageDriver(ImageDriver::Gd)->load($srcPath)
            ->crop($w, $h, CropPosition::Center)
            ->watermark(
                base_path('public/media/Logo.png'),
                paddingX: 5,
                paddingY: 5,
                width: 200,
                height: 200,
                paddingUnit: Unit::Percent
            )
            ->save($destPath);
    }
}
