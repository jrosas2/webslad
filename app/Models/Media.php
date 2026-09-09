<?php

namespace App\Models;

use Database\Factories\MediaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['disk', 'path', 'filename', 'alt_text', 'mime_type', 'size'])]
class Media extends Model
{
    /** @use HasFactory<MediaFactory> */
    use HasFactory;

    public function url(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }
}
