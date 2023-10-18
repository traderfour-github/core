<?php

namespace App\Services\Post;

use App\Enums\V1\Post\Status;
use App\Repositories\V1\Post\PostRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreatePostService
{

    public function __construct(
        private PostRepository $productRepository,
        private PostMediaService $appMediaService
    ) {
    }

    public function perform(
        string $user_id,
        string $title,
        string $slogan,
        string $introduction,
        string $description,
        int $type,
        string $categories,
        string $tags,
        string $platforms,
        string $logo = null,
        string $cover = null,
        array $attachment = null
    ){

            $product = $this->productRepository->create([
                'user_id'      => $user_id,
                'title'        => $title,
                'slogan'       => $slogan,
                'introduction' => $introduction,
                'description'  => $description,
                'type'         => $type,
                'published_at' => Carbon::now(),
                'cover'         => $cover,
                'logo'          => $logo,
                'status'       => Status::Pending,
            ]);

        $product->categories()->sync($this->castStringAsArray($categories));

        $product->tags()->sync($this->castStringAsArray($tags));

        if(!is_null($attachment)){
            $product->attachments()->sync($attachment);
        }

        $product->platforms()->sync($this->castStringAsArray($platforms));
            return $product;

    }

    public function update(string $id,array $data){

        $product =  $this->productRepository->find($id)->first();
        $product->update($data);
        return $product;

    }

    public function deleteProduct(string $id)
    {
        $this->productRepository->find($id)->delete();
    }

    public function upload($image):string
    {
        $extension = $image->extension();
        $filename = Str::uuid() . "." . $extension;
        $path = config('werify.ticket.path') . $filename;
        // Storage::cloud()->put($path, file_get_contents($image));
        Storage::put($path, file_get_contents($image));
        return $path;
    }

    protected function castStringAsArray(string $string): array
    {
        return array_filter(explode(',', $string));
    }

}
