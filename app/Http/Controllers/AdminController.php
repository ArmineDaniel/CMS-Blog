<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


abstract class AdminController extends Controller
{
    protected $model;
    public function index()
    {
        return view('dashboard');
    }
    public function getClassName() {
        $reflect = new \ReflectionClass($this->model);
        return $reflect->getShortName();
    }

    abstract public function show(Request $request);

    public function create()
    {
        $categories = Category::whereNotNull('published_at')->get();
        return view("add{$this->getClassName()}", compact('categories'));
    }

    abstract public function store(Request $request);

    public function edit($id)
    {
        $modelName = lcfirst("{$this->getClassName()}");
        $$modelName = $this->model->find($id);
        $categories = Category::whereNotNull('published_at')->get();
        return view("edit{$this->getClassName()}", compact("{$modelName}", 'categories'));
    }

    public function delete($id)
    {
        $modelName = lcfirst("{$this->getClassName()}");
        $$modelName = $this->model->find($id);
        $$modelName->delete();
        return Redirect::back();
    }
    public function publish($id)
    {
        $modelName = lcfirst("{$this->getClassName()}");
        $$modelName = $this->model->find($id);
        date_default_timezone_set('Asia/Yerevan');
        $$modelName->published_at  = date("Y-m-d H:i:s");
        $$modelName->save();
        return Redirect::back();
    }
    public function draft($id)
    {
        $modelName = lcfirst("{$this->getClassName()}");
        $$modelName = $this->model->find($id);
        $$modelName->published_at  = null;
        $$modelName->save();
        return Redirect::back();
    }

   abstract public function update(Request $request, $model);
}
