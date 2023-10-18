<?php

namespace App\Repositories\V1\Post;

use App\Enums\V1\Post\Status;
use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Tag;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use EloquentBuilder;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostRepository extends AbstractRepository implements IPostRepository
{
    public function index(array $data = null): LengthAwarePaginator
    {
        return $this->getPostsList($data);
    }

    public function create(array $attributes = []): Post
    {
        $post = $this->model->create($attributes);
        if (array_key_exists('logo_id', $attributes)){
            $post->attachmentables()->create([
                'attachment_id' => $attributes['logo_id'],
                'attachmentable_field' => 'logo',
            ]);
        }
        if (array_key_exists('cover_id', $attributes)){
            $post->attachmentables()->create([
                'attachment_id' => $attributes['cover_id'],
                'attachmentable_field' => 'cover',
            ]);
        }
        if (array_key_exists('attachments', $attributes)){
            foreach ($attributes['attachments'] as $attachment){
                $post->attachmentables()->create([
                    'attachment_id' => $attachment,
                    'attachmentable_field' => 'attachments',
                ]);
            }
        }
        if (array_key_exists('categories', $attributes)) $post->categories()->sync($attributes['categories']);
        if (array_key_exists('tags', $attributes)){
            foreach ($attributes['tags'] as $tag){
                $tag = Tag::firstOrCreate(['title' => $tag]);
                $post->tags()->attach($tag->id);
            }
        }
        if (array_key_exists('markets', $attributes)) $post->markets()->sync($attributes['markets']);
        if (array_key_exists('platforms', $attributes)) $post->platforms()->sync($attributes['platforms']);
        if (array_key_exists('licenses', $attributes)) $post->licenses()->sync($attributes['licenses']);
        return $post;
    }

    public function show(string $slogan)
    {
        return $this->model->where('slogan', $slogan)->firstOrFail();
    }
    public function exists(string $slogan)
    {
        return $this->model->where('slogan', 'LIKE', '%'.$slogan.'%')->orderBy('slogan', 'desc')->first();
    }

    public function getUserPost($user_id, string $uuid)
    {
        return $this->model->where('user_id', $user_id)->findOrFail($uuid);
    }

    public function getUserPostsList($user_id, array $data = null): LengthAwarePaginator
    {
        return $this->getPostsList($data, $user_id);
    }

    private function getPostsList(array $data = null, ?string $user_id = null): LengthAwarePaginator
    {
        $sort = null;

        if (array_key_exists('sort', $data)) {
            $sort = $data['sort'];
            unset($data['sort']);
        }

        $query = EloquentBuilder::to($this->model, $data);

        if (isset($user_id)) {
            $query->where(['user_id' => $user_id]);
        }

        $query = match ($sort) {
            'trending' => $this->sortByTrending($query),
            'latest' => $this->sortByLatest($query),
            'popular' => $this->sortByPopularity($query),
            default => $query,
        };

        return $query->paginate();
    }

    public function related(string $uuid): LengthAwarePaginator
    {
        $product       = $this->findWithRelation($uuid, ['categories:id']);
        $categoryUuids = collect($product->categories)->pluck('id');

        return $this->model->whereHas('categories', function ($query) use ($categoryUuids) {
            return $query->whereIn('id', $categoryUuids);
        })->where('id', '<>', $product->id)->paginate();
    }

    public function syncPopularityScores(): bool
    {
        try {
            $this->model->where('status', Status::Active->value)->update([
                'popularity_score' => DB::raw('(view_count+comment_count*5)/2'),
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return true;
    }

    public function getPostsByCategoryId(string $categoryId): LengthAwarePaginator
    {
        return $this->model->whereRelation('categories', 'id', $categoryId)->paginate();
    }

    public function getPostsByTagId(string $tagId): LengthAwarePaginator
    {
        return $this->model->whereRelation('tags', 'id', $tagId)->paginate();
    }

    private function sortByTrending(Builder $query): Builder
    {
        // todo: order by the most purchased within the last month
        return $query->orderByDesc('purchase_count');
    }

    private function sortByLatest(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    private function sortByPopularity(Builder $query): Builder
    {
        return $query->orderByDesc('popularity_score');
    }

    protected function castStringAsArray(string $string): array
    {
        return array_filter(explode(',', $string));
    }

    protected function instance(array $attributes = []): Post
    {
        return new Post();
    }
}
