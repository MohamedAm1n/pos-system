<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
            $categories=Category::when($request->search,function($q) use($request){
                return $q->where('cat_name','like','%' . $request->search . '%');
            })->paginate(3);
        
        // $categories=Category::paginate(5);
        return view('dashboard.categories.cat_index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.cat_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = $request->validate(['cat_name'=>'required|string|min:3']);
        if(!$cat)
            return back()->with('errors');
        Category::create($cat);

        return redirect(route('categories.index'))->with('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.cat_edit', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all());
        $cat = $request->validate(['cat_name'=>'required|string|min:3|unique:categories,cat_name']);
        if(!$cat)
            return back()->with('errors');
        $category->update($cat);
        return redirect(route('categories.index'))->with('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $cat=$category->id;
        Category::destroy($cat);
        return redirect(route('categories.index'));
    }
}
