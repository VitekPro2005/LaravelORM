<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CategoryPostController extends Controller
{
    public function index() {
        $categories = DB::table('categories')->get();

        return view('posts.categories.index', [
            'categories' => $categories]
        );
    }

    public function show($id)
    {
        $category = DB::table('categories')->find($id);

        if (!$category) {
            abort(404, "Категории не существует");
        }

        $posts = DB::table('posts')
        ->where('category_id', $id)
        ->get();

        return view('posts.categories.show', [
            'category' => $category,
            'posts' => $posts
        ]);
            //TODO извлечь посты категории
            //Покажите на странице и имя категории и посты этой категории
    }

}
