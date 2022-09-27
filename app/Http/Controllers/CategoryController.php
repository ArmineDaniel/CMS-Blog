<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    public function show(Request $request)
    {
        $categories = $this->model->paginate(3);
        if($request->search){
            $categories = $this->model->where('title', 'like', "%{$request->search}%")->paginate(3)->withquerystring();
            return view('categories', compact('categories'));
        }
        else{
            return view('categories', compact('categories'));
        }
    }
    public function store(Request $request)
    {
        $category = new Category();
        $category->title = $request->categoryTitle;
        $category->description = $request->categoryDescription;
        $category->image ="uploads/".basename($_FILES["categoryImage"]["name"]);
        move_uploaded_file($_FILES["categoryImage"]["tmp_name"],$category->image);
        $category->meta_title = $request->categoryMeta_title;
        $category->meta_description = $request->categoryMeta_description;
        $request->validate([
            'categoryTitle' => 'required',
            'categoryDescription' => 'required',
            'categoryMeta_title' => 'required',
            'categoryMeta_description' => 'required',
            'checked' => 'max:1',
        ]);
        if($request->checked){
            $category->parent_id = implode('',$request->checked);
        }
        $category->save();
        return redirect('/categories');
    }

    public function update(Request $request, $id)
    {
        $category = $this->model->find($id);
            $category->title = $request->categoryTitle;
            $category->description = $request->categoryDescription;
            if($request->categoryImage !== null){
                $category->image = "uploads/".basename($_FILES["categoryImage"]["name"]);
                move_uploaded_file($_FILES["categoryImage"]["tmp_name"],$category->image);
            }
            $category->meta_title = $request->categoryMeta_title;
            $category->meta_description = $request->categoryMeta_description;
            $request->validate([
                'categoryTitle' => 'required',
                'categoryDescription' => 'required',
                'categoryMeta_title' => 'required',
                'categoryMeta_description' => 'required',
                'checked' => 'max:1',
            ]);
            if($request->checked){
                $category->parent_id = implode('',$request->checked);
            }
            else{
                $category->parent_id = null;
            }
            $category->save();
            return redirect('/categories');
        }
}
