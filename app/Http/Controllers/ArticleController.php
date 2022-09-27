<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends AdminController
{
    public function __construct(Article $model)
    {
        $this->model = $model;
    }
    public function show(Request $request)
    {
        $articles = $this->model->paginate(3);
        if($request->search){
            $articles = $this->model->where('title', 'like', "%{$request->search}%")->orWhere('hashtags', 'like', "%{$request->search}%")->paginate(3)->withquerystring();
            return view('articles', compact('articles'));
        }
        else{
            return view('articles', compact('articles'));
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
        $article = new Article();
        $article->title = $request->articleTitle;
        $article->description = $request->articleDescription;
        $article->text = $request->articleText;
        $article->image = "uploads/".basename($_FILES["articleImage"]["name"]);
        move_uploaded_file($_FILES["articleImage"]["tmp_name"],$article->image);
        $article->meta_title = $request->articleMeta_title;
        $article->meta_description = $request->articleMeta_description;
        $article->hashtags = str_replace(' ', '', $request->hashtags);
        $request->validate( [
            'articleTitle' =>'required',
            'articleDescription' => 'required',
            'articleText' => 'required',
            'articleMeta_title' => 'required',
            'articleMeta_description' => 'required',
            'checked' => 'required',
        ]);
        $article->save();
        foreach ($request->checked as $value){
            $article->categories()->attach([$value]);
        }
        $article->save();
            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        finally{
            return redirect('/articles');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $article = $this->model->find($id);
            $article->title = $request->articleTitle;
            $article->description = $request->articleDescription;
            $article->text = $request->articleText;
            if ($request->articleImage !== null) {
                $article->image = "uploads/".basename($_FILES["articleImage"]["name"]);
                move_uploaded_file($_FILES["articleImage"]["tmp_name"], $article->image);
            }
            $article->meta_title = $request->articleMeta_title;
            $article->meta_description = $request->articleMeta_description;
            $article->hashtags = str_replace(' ', '', $request->hashtags);
            $request->validate([
                'articleTitle' => 'required',
                'articleDescription' => 'required',
                'articleText' => 'required',
                'articleMeta_title' => 'required',
                'articleMeta_description' => 'required',
                'checked' => 'required',
            ]);
            $article->save();
            $article->categories()->sync($request->checked);
            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
       finally{
           return redirect('/articles');
       }
    }
}
