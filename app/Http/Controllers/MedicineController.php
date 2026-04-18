<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Supprot\Facades\Gate;

class MedicineController extends Controller
{
    public function index(){
        $medicines = Medicine::with('category')->get();
    return view('admin.medicines.index',compact('medicines'));
    }


    public function create(){
        $categories = Category::orderBy('name','asc')->get();
    return view('admin.medicines.create', compact('categories'));
    }

    public function search(Request $request)
{
    $query = $request->get('q', '');

    $medicines = Medicine::with('category')
        ->where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('generic_name', 'like', "%{$query}%")
              ->orWhere('barcode', 'like', "%{$query}%");
        })
        ->limit(10)
        ->get();

    return response()->json($medicines);
}
   
public function store(Request $request)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'generic_name'     => 'required|string',
        'category_id' => 'required|exists:categories,id', 
        'description' => 'nullable|string',
        'barcode'     => 'nullable|string|max:100|unique:medicines,Barcode',
        'sell_price'     => 'nullable|numeric|min:0'  ?? 0,
        'buy_price'     => 'nullable|numeric|min:0',
        'quantity'        => 'nullable|integer|min:0',
        'expiry_date'     => 'nullable|date|after:today',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_active'      => 'required|boolean',
    ]);

    
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('meicines', 'public');
    }
    $validated['sell_price'] = $validated['sell_price'] ?? 0;
    $validated['buy_price']= $validated['buy_price'] ?? 0;
    $validated['quantity'] = $validated['quantity'] ?? 0;
    $validated['expiry_date'] = $validated['expiry_date'] ?? '1970-01-01';
    Medicine::create($validated);

    return redirect()->back()->with('success', 'Mahsulot saqlandi');
}




    public function edit(Medicine $medicine){
        $categories = Category::all();
   
    return view('admin.medicines.edit', compact('medicine', 'categories'));

    } 



    public function update(Request $request,Medicine $medicine ){
    $validated = $request->validate([
          'name'        => 'required|string|max:255',
        'generic_name'     => 'required|string',
        'category_id' => 'required|exists:categories,id', 
        'description' => 'nullable|string',
        'barcode'       => 'required|string|max:100|unique:medicines,barcode,' . $medicine->id,
        'sell_price'     => 'required|numeric|min:0',
        'buy_price'     => 'required|numeric|min:0',
        'quantity'        => 'required|integer|min:0',
        'expiry_date'     => 'required|date|after:today',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_active'      => 'required|boolean',
    ]);
    if($request->hasFile('image')){
        if($medicine->image){
            Storage::disk('public')->delete($medicine->image);
        }
        $validated['image']=$request->file('image')->store('meicines','public');

    }
    $medicine->update($validated);
    return redirect()->route('medicine.index')->with('success', 'Malumot yangilandi ');
    }



    public function show(Medicine $medicine){
       
    return view('admin.medicines.read', compact('medicine'));
    }



    public function destroy(Medicine $medicine){
        Gate::authorize('isAdmin');
    if($medicine->image){
        Storage::disk('public')->delete($medicine->image);
    }
    $medicine->delete($medicine = 'deleted_at' );
    return redirect()->route('medicine.index')->with('success', 'Malumot ochirildi');
    }
}
