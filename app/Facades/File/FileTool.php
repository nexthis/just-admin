<?php

namespace App\Facades\File;

use App\Jobs\CreateImage;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Storage;

class FileTool
{
    private $title = '';
    private $source = '';
    private $model = '';
    private $public = true;
    /**
     * @var UploadedFile
     */
    private $file;

    /***
     * set App\Models\File title
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): FileTool
    {
        $this->title = $title;
        return $this;
    }

    /***
     * set App\Models\File source
     * @param string $source
     * @return $this
     */
    public function setSource(string $source): FileTool
    {
        $this->source = $source;
        return $this;
    }

    /***
     * set App\Models\File public
     * @param bool $public
     * @return $this
     */
    public function setPublic(bool $public): FileTool
    {
        $this->public = $public;
        return $this;
    }

    /***
     * @param UploadedFile $file
     * @return $this
     */
    public function file(UploadedFile $file): FileTool
    {
        $this->file = $file;
        return $this;
    }

    /***
     * @param string|null $model
     * @return $this
     */
    public function model(?string $model): FileTool
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $extension
     * @param bool $public
     * @param string $prefix
     * @return string
     */
    public function getPath(string $type, string $name, string $extension, bool $public = true,string $prefix = ''):string
    {
        return  ($public ? 'public' : 'private') . '/' . $type.'/'.$name.'/'.$name . ($prefix !== '' ? '@'. $prefix : '') .'.'.$extension;
    }

    /***
     * @return File
     */
    public function make(): File
    {

        $file = new File();
        $file->name = Str::random(20);
        $file->original_name = $this->file->getClientOriginalName();
        $file->extension = $this->file->getClientOriginalExtension();
        $file->size = $this->file->getSize();
        $file->title = $this->title;
        $file->source = $this->source;
        $file->public = $this->public;
        $file->type = Str::before($this->file->getMimeType(), '/');

        if(Str::contains( $this->file->getMimeType(), 'image')){
            $image_size = getimagesize($this->file);
            $file->width = $image_size[0];
            $file->height = $image_size[1];
            if(isset($this->model) && property_exists($this->model, 'thumbsConfig')){
                $config = $this->model::$thumbsConfig;
                if($config['default'] !== null)
                    CreateImage::dispatch($file, $this->file, $config['default'], [], true);

                foreach ($config as $item){
                    if(key($item) !== 'default')
                        continue;
                    CreateImage::dispatch($file, $this->file, $item, []);
                }
            }


        }

        //dd($this->getPath($file->type,$file->name, $file->extension, $file->public));

        Storage::put($this->getPath($file->type,$file->name, $file->extension, $file->public), file_get_contents( $this->file));
        $file->save();

        dd($this->getPath($file->type, $file->name, $file->extension, $file->public));

        return $file;
    }
}