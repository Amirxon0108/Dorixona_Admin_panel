<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        Category::create($validated);
        return redirect()->route('category.index')->with('succes','Malumot saqlandi');
    }


    public function show($id){
        $category = Category::findOrFail($id);
        return view('admin.category.read', compact('category'));
    }



    public function edit(Category $category){
   
    return view('admin.category.edit', compact('category'));
    }



    public function update(Request $request, Category $category){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);
        $category->update($validated);
        return redirect()->route('category.index')->with('success', 'Malumot yangilndi');
    }


     public function destroy(Category $category){
    
    $category->delete();
    return redirect()->route('category.index')->with('success', 'Malumot ochirildi');
    }
}           
