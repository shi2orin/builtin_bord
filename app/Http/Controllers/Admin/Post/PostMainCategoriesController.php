<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;

class PostMainCategoriesController extends Controller
{
    public function show()
    {
        $main_categories = PostMainCategory::get();
        $sub_categories = PostSubCategory::get();
        return view('authenticated.category', compact('main_categories', 'sub_categories'));
    }
    public function mainCategoryCreate(Request $request)
    {
        $request->validate(
            [
                'main_category' => ['required', 'string', 'max:100', 'unique:post_main_categories']
            ],
            [
                'main_category.required' => '※メインカテゴリー名は必須です。',
                'main_category.max' => '※100文字以内で記入してください。',
                'main_category.unique' => '※既に登録されています。',
            ]
        );
        PostMainCategory::create(['main_category' => $request->main_category]);
        return redirect()->route('category.show');
    }
    public function mainCategoryDelete($id)
    {
        PostMainCategory::where('id', $id)->delete();
        return redirect()->route('category.show');
    }
    public function subCategoryCreate(Request $request)
    {
        $request->validate(
            [
                'main_category_id' => ['required', 'exists:post_main_categories,id'],
                'sub_category' => ['required', 'string', 'max:100', 'unique:post_sub_categories'],
            ],
            [
                'main_category_id.required' => '※メインカテゴリーは必須です。',
                'main_category_id.exists' => '※登録済みのメインカテゴリーから選択してください。',
                'sub_category.required' => '※サブカテゴリーは必須です。',
                'sub_category.max' => '※サブカテゴリー100文字以内で記入してください。',
                'sub_category.unique' => '※既に登録されています。',
            ]
        );

        PostSubCategory::create([
            'post_main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category
        ]);
        return redirect()->route('category.show');
    }

    public function subCategoryDelete($id)
    {
        PostSubCategory::where('id', $id)->delete();
        return redirect()->route('category.show');
    }
}
