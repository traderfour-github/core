<?php

namespace App\Services\Post;

use App\Models\App;
use App\Repositories\V1\Post\PostRepository;
use App\Services\Post\Payloads\PostMediaPayload;

class UpdatePostService
{

    public function __construct(
        private PostRepository $repository,
        private PostMediaService $mediaService
    ) {
    }

    public function perform(
        App $app,
        string $title,
        string $slogan,
        string $introduction,
        string $description,
        array $categories,
        array $tags,
        array $platforms,
        PostMediaPayload $appMediaPayload
    ): App {
        return $this->appRepository->transactional(function () use (
            $app,
            $title,
            $slogan,
            $introduction,
            $description,
            $categories,
            $tags,
            $platforms,
            $appMediaPayload
        ) {
            $app = $this->appRepository->updateModel(
                $app,
                [
                    'title'        => $title,
                    'slogan'       => $slogan,
                    'introduction' => $introduction,
                    'description'  => $description,
                ]);

            $app->categories()->sync($categories);
            $app->tags()->sync($tags);
            $app->platforms()->sync($platforms);

            $this->appMediaService->addLogo($app, $appMediaPayload->getLogo());
            $this->appMediaService->addCover($app, $appMediaPayload->getCover());

            return $app;
        });
    }
}
