<?php

namespace App\Services\Post;

use App\Models\App;
use App\Models\Trader4\V1\Post;
use App\Repositories\V1\Post\PostRepository;
use Illuminate\Http\UploadedFile;

class PostMediaService
{
    public function __construct(private PostRepository $appRepository)
    {
    }

    public function addLogo(Post $product, UploadedFile $logo): string
    {//TODO should handle min.io storage
        if (!empty($product->logo)){
            $this->removeOldMediaFile(storage_path('applications/logos/') . $product->logo);
        }

        $imageName = $this->getMediaName($product, $logo);
        $logo->move(storage_path('applications/logos'), $imageName);

        $this->appRepository->updateModel($product, [
            'logo' => $imageName
        ]);

        return $imageName;
    }

    public function addCover(\App\Models\Trader4\V1\Post $product, UploadedFile $cover): string
    {//TODO should handle min.io storage
        if (!empty($product->cover)){
            $this->removeOldMediaFile(storage_path('applications/covers/') . $product->cover);
        }

        $imageName = $this->getMediaName($product, $cover);
        $cover->move(storage_path('applications/covers'), $imageName);

        $this->appRepository->updateModel($product, [
            'cover' => $imageName
        ]);

        return $imageName;
    }

    private function removeOldMediaFile(string $path)
    {
        if(file_exists($path)){

            return unlink($path);
        }

        return true;
    }


    private function getMediaName(\App\Models\Trader4\V1\Post $product, UploadedFile $file): string
    {
        return md5(time() . $product->id) . '.' . $file->extension();
    }
}
