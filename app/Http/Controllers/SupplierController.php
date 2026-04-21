<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function search(Request $request){

    $query = $request->get('q', '');

    $total = Supplier::where('name', 'like', "%{$query}%")
    ->orWhere('phone', 'like', "%{$query}%")
    ->orWhere('address', 'like', "%{$query}%")
    ->count();

    $suppliers = Supplier::where('name', 'like', "%{$query}%")
    ->orWhere('phone', 'like', "%{$query}%")
    ->orWhere('address', 'like', "%{$query}%")
    ->limit(10)
    ->get();

    return response()->json([
        'total' => $total,
        'data'  => $suppliers,
    ]);
   
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:35',
            'address' => 'required|string|max:255'
        ]);

        Supplier::create($validated);
        return redirect()->back()->with('success', 'malumot qoshildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255'
        ]);

        $supplier->update($validated);

        return to_route('supplier.index')->with('success', 'yangilandi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        Gate::authorize('isAdmin');
        $supplier->delete();
        return redirect()->back()->with('success', 'Malumot ochirildi');
    }
}
