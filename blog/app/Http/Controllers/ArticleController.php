<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view("articles.index", [
            "articles" => $data
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view("articles.detail", [
            "article" => $article,
        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect("/articles")->with("info", "An article is deleted");
    }
}
