<?php

namespace App\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileSystem
{
    /**
     * @param  Request  $r
     *
     * @return JsonResponse|string|null
     */
    public function bulkUpload(Request $r): JsonResponse|string|null
    {
        try{
            foreach ($r->file('files') as $file){
                return $this->upload($file);
            }
            return dd('s');
        }catch (\Exception $e){
            return $this->exceptionHandler($e);
        }
    }

    /**
     * @param  UploadedFile  $file
     *
     * @return JsonResponse|string
     */
    public function upload(UploadedFile $file): JsonResponse|string
    {
        try{
            $extension = $file->extension();
            $filename = Str::uuid() . "." . $extension;
            $path = config('trader4.path.general') . $filename;
            Storage::cloud()->put($path, file_get_contents($file));
            return $path;
        }catch (\Exception $e){
            return $this->exceptionHandler($e);
        }
    }

    /**
     * @param  string  $path
     * @param  bool|null  $signed
     *
     * @return \Exception|string|JsonResponse|null
     */
    public function link(string $path, ?bool $signed = false): \Illuminate\Http\JsonResponse|\Exception|string|null
    {
        //@TODO: Integrated with Briofy/fs-laravel
        if($signed){
            $time = now()->addMinutes(config('trader4.temporary_url'));
            return Storage::cloud()->temporaryUrl($path,$time);
        }
        return Storage::cloud()->url($path);
    }
}
