<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class UpdateStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update older articles status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articles = Article::getOlder()->get();

        foreach ($articles as $article) {
            $article->update(['status' => Article::STATUSES['inactive']]);
        }
    }
}
