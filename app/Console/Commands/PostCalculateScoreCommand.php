<?php

namespace App\Console\Commands;

use App\Repositories\V1\Post\IPostRepository;
use Illuminate\Console\Command;

class PostCalculateScoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:calculate-score';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate posts score.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $repository = app()->make(IPostRepository::class);

        $this->comment('Running calculate command...');

        if (! $repository->syncPopularityScores()) {
            $this->error('Failed to calculate and sync post popularity scores.');
        }

        $this->info('Post popularity scores synced successfully.');
    }
}
