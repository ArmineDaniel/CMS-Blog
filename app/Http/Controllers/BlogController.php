<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::whereNotNull('published_at')->paginate(3)->withquerystring();;
        $categories = Category::whereNotNull('published_at')->whereNull('parent_id')->with('children')->get();
        if(isset($request->search)){
            $articles = Article::whereNotNull('published_at')->where( 'title', 'LIKE', '%' . $request->search . '%' )
                    ->orWhere( 'hashtags', 'LIKE', '%' . $request->search . '%' )->paginate(3)->withquerystring();
            return view('home', compact('articles', 'categories'));
        }
        else{
            return view('home', compact('articles', 'categories'));
       }

    }

    public function searchHashtag($hashtag)
    {
        $articles = Article::whereNotNull('published_at')->where( 'hashtags', 'LIKE', '%' . $hashtag . '%' )->paginate(3)->withquerystring();;
        $categories = Category::whereNotNull('published_at')->whereNull('parent_id')->with('children')->get();
        return view('home', compact('articles', 'categories'));
    }
    public function ascending()
    {
        $categories = Category::whereNotNull('published_at')->whereNull('parent_id')->with('children')->get();
        $articles = Article::whereNotNull('published_at')->orderBy('published_at')->paginate(3)->withquerystring();
        return view('home',compact('articles', 'categories'));
    }

    public function descending()
    {
        $categories = Category::whereNotNull('published_at')->whereNull('parent_id')->with('children')->get();
        $articles = Article::whereNotNull('published_at')->orderByDesc('published_at')->paginate(3)->withquerystring();
        return view('home',compact('articles', 'categories'));
    }
    public function readArticle(Article $article)
    {

        return view('singleArticlePage', compact('article'));
    }

   public function filter(Request $request)
    {
        $categories = Category::whereNotNull('published_at')->whereNull('parent_id')->with('children')->get();;
        $articles = Category::where('title', $request->category)->first()->articles()->whereNotNull('published_at')->paginate(3)->withquerystring();

 return view('home', compact('articles', 'categories'));
   }
}
