<?php

namespace Database\Seeders;

use App\Enums\V1\Category\Bot;
use App\Enums\V1\Category\FundedAccount;
use App\Enums\V1\Category\Type;
use App\Models\Trader4\V1\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Type::cases() as $categotyType){
            $title = ucwords(strtolower(str_replace('_', ' ', $categotyType->name)));
            $slug = strtolower(str_replace(' ', '-', $title));
            $parent_id = Category::firstOrCreate(['title' => $title, 'slug' => $slug, 'type' => $categotyType->value]);
            if($categotyType->name === "BOT")
                $this->createBotCategories($parent_id->id);
            else if($categotyType->name === "FUNDED_ACCOUNT")
                $this->createFundedAccountCategories($parent_id->id);
        }
    }

    protected function createBotCategories(string $parent_id){
        foreach (Bot::cases() as $cat){
            $title = ucwords(strtolower(str_replace('_', ' ', $cat->name)));
            $slug = strtolower(str_replace(' ', '-', $title));
            Category::firstOrCreate(['title' => $title, 'slug' => $slug, 'parent_id' => $parent_id, 'type' => $cat->value]);
        }
    }

    protected function createFundedAccountCategories(string $parent_id){
        foreach (FundedAccount::cases() as $cat){
            $title = ucwords(strtolower(str_replace('_', ' ', $cat->name)));
            $slug = strtolower(str_replace(' ', '-', $title));
            Category::firstOrCreate(['title' => $title, 'slug' => $slug, 'parent_id' => $parent_id, 'type' => $cat->value]);
        }
    }
}
