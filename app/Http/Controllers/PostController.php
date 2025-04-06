<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->select('id', 'title')
            ->orderByDesc('id')
            ->pluck('title', 'id');

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        $post = DB::table('posts')->find($id);

        if (is_null($post)) {
            abort(404);
        }

        $category = DB::table('categories')->find($post->category_id);

        return view('posts.show', [
            'post' => $post,
            'category' => $category,
        ]);
    }

    public function create()
    {
        $categories = DB::table('categories')->get();

        return view('posts.create', [
            'categories' => $categories
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        DB::table('posts')->insert([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.index');
    }

    public function edit(int $id)
    {
        $post = DB::table('posts')->find($id);
        $categories = DB::table('categories')->get();

        if (is_null($post)) {
            abort(404, 'Поста не существует');
        }

        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(StorePostRequest $request, int $id)
    {
        $validated = $request->validated();

        DB::table('posts')
            ->where('id', $id)
            ->update([
                'title' => $validated['title'],
                'category_id' =>  $validated['category_id'],
                'content' => $validated['content']
            ]);
        return redirect()->route('posts.show', $id);
    }

    public function destroy(int $id)
    {
        DB::table('posts')->delete($id);

        return redirect()->route('posts.index');
    }

    public function download()
    {
        $filename = storage_path('app/posts.json');
        
        return response()->download($filename);
    }

    // TODO: GET + PUT (Обновление поста) (@method('PUT') внутри формы blade при обновлении)
    // TODO: DELETE (Удаление поста) (/post/{id})
}
