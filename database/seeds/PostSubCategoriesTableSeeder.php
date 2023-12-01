<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostSubCategory;


class PostSubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostSubCategory::create([
            'post_main_category_id' => 1,
            'sub_category' => 'Laravel',
        ]);
        PostSubCategory::create([
            'post_main_category_id' => 1,
            'sub_category' => 'PHP',
        ]);
    }
}
