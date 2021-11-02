<?php

namespace App\Models;

use App\Facades\File\FileTool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Storage;

class File extends Model
{
    use HasFactory;
    protected $appends = ['path', 'url'];

    public function getUrlAttribute(): string
    {
        return Storage::url(\FileTool::getPath($this->type,$this->name, $this->extension, $this->public));
    }

    public function getPathAttribute(): string
    {
        return \FileTool::getPath($this->type,$this->name, $this->extension, $this->public);
    }

    public  function thumbs(): HasMany
    {
        return $this->hasMany(ImageThumb::class);
    }
}
