<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    function toarticleedit($id)
    {
        $article = Article::with('category')->where('id', $id)->first();
        $categories = Category::where('status', 1)->get();
        return view('admin.article.edit_article', compact('article', 'categories'));
    }


    function toarticledelete($id)
    {
        $plumber = DB::table('articles')->where('id', $id)->delete();
        return redirect()->back()->with('success', ' Delete Successfully');
    }

    function toarticleadd()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.article.add_article', compact('categories'));
    }

    function toarticlestore(Request $request)
    {
        $this->validate($request, [
            'title' =>  "required",
            'description' =>  "required",
            'image' =>  "required",
            'category_id' =>  "required",
        ]);
        $data = array();
        $data['article_title'] = $request->get('title');
        $data['category_id'] = $request->get('category_id') ?? null;
        $data['slug']   = Str::slug($request->get('title'));
        $data['meta_title']      = $request->get('meta_title') ?? null;
        $data['meta_keyword']    = $request->get('meta_keyword') ?? null;
        $data['meta_description']  = $request->get('meta_description') ?? null;
        $data['article_description'] = $request->get('description');
        $data['article_sort'] = $request->get('sort') ?? 50;
        $data['article_status'] = $request->get('status');
        $data['article_image'] = $request->get('image');
        $query_insert = DB::table('articles')->insert($data);
        if ($query_insert) {
            return redirect()->back()->with('success', ' Create Successfully');
        }
    }


    function toarticleupdate(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>  "required",
            'description' =>  "required",
            'image' =>  "required",
            'category_id' =>  "required",
        ]);

        $update = DB::table('articles')->where('id', $id)->update(
            [
                'article_title' => $request->get('title'),
                'slug' => Str::slug($request->get('title')),
                'category_id' => $request->get('category_id'),
                'meta_title' => $request->get('meta_title') ?? null,
                'meta_keyword' => $request->get('meta_keyword') ?? null,
                'meta_description'  => $request->get('meta_description') ?? null,
                'article_description' => $request->get('description'),
                'article_sort' => $request->get('sort') ?? 50,
                'article_status' => $request->get('status'),
                'article_image' => $request->get('image') ?? null,
            ]
        );
        return redirect()->back()->with('success', '  Update Successfully');
    }


    function toarticle()
    {
        $article = Article::with('category')->orderBy('id', 'DESC')->paginate(12);
        return view('admin.article.list_article', compact('article'));
    }
}
