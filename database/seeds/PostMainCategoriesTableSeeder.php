<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostMainCategory;

class PostMainCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostMainCategory::create([
            'main_category' => 'プログラミング',
        ]);
    }
}
