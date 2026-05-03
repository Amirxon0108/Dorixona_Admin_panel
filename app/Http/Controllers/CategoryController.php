<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function search(Request $request){
        $query = $request->get('q', '');

        $total = Category::where('name', 'like', "%{$query}%")
        ->count();
        

        $categories = Category::where('name', 'like', "%{$query}%")
        ->limit(10)
        ->get();

        return response()->json([
            'total' => $total,
            'data' => $categories,  
            ]);
        }
    public function create(){
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

    public function store(Request $request){
         Gate::authorize('isAdmin');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        Category::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'action'  => 'Kategory qoshildi',
            'description' => '',
        ]);
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

        Log::create([
            'user_id' => auth()->id(),
            'action'  => 'Kategory yangilandi',
            'description' => '',
        ]);

        return redirect()->route('category.index')->with('success', 'Malumot yangilndi');
    }


     public function destroy(Category $category){
    Gate::authorize('isAdmin');
    $category->delete();
    Log::create([
            'user_id' => auth()->id(),
            'action'  => 'Kategory ochirildi',
            'description' => '',
        ]);
    return redirect()->route('category.index')->with('success', 'Malumot ochirildi');
    }
}           
