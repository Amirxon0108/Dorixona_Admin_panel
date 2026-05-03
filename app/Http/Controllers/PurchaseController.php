<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PurchaseController extends Controller
{

public function index(){
    $purchases = Purchase::latest()->paginate(10);
    return view('admin.purchases.index', compact('purchases'));
}


public function search(Request $request){
    $query = $request->get('q', '');

    $total = Purchase::where('purchase_no', 'like', "%{$query}%")
     ->orWhere('purchase_date', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%") 
        ->count();


    $purchases = Purchase::with('supplier', 'user')
    ->where(function($q) use ($query){
        $q->where('purchase_no', 'like', "%{$query}%")
            ->orWhere('purchase_date', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%") ;
    })->limit(10)
    ->get();
    return response()->json([
        'total' => $total,
        'data' => $purchases,
    ]);
}

public function create(){
    $purchases= Purchase::all();
    $suppliers = Supplier::all();
    $users =User::all();
return view('admin.purchases.create', compact('suppliers', 'users','purchases'));
}

public function store(Request $request){
     Gate::authorize('isAdmin');
    $validated = $request->validate([
        'supplier_id'   => 'required|exists:suppliers,id',
        'user_id'       => 'required|exists:users,id',
        'payment_method'=> 'required|in:cash,card,transfer',
        'status'        => 'required|in:completed,pending,cancelled',
        'purchase_no'   => 'required|string',
        'purchase_date' => 'required|date',
        'total_amount'  => 'required|numeric',
        'description'   => 'required|string',
    ]);

    Purchase::create($validated);
    
    Log::create([
        'user_id' => auth()->id(),
        'action' => 'Omorga qoshildi',
        'description' => '',
    ]);
    return redirect()->back()->with('success', 'malumot qoshildi');
}

public function show(Purchase $purchase){


return view('admin.purchases.show', compact('purchase'));
}


public function edit(Purchase $purchase){
$suppliers = Supplier::all();
$users = User::all();
return view('admin.purchases.edit', compact('purchase', 'suppliers', 'users'));
}


public function update(Request $request, Purchase $purchase){

$validated = $request->validate([
      'supplier_id'    => 'required|exists:suppliers,id',
        'user_id'       => 'required|exists:users,id',
        'purchase_no'   => 'required|string',
        'purchase_date' => 'required|date',
        'total_amount'  => 'required|numeric',
        'description'   => 'required|string',
]);

$purchase->update($validated);

Log::create([
    'user_id' => auth()->id(),
    'action'  => 'Ombor Yangilandi',
    'description' => '',
]);
return redirect()->route('purchase.index')->with('success', 'Malumot yangilandi ');
}


public function destroy(Purchase $purchase){
    Gate::authorize('isAdmin');
 $purchase->delete();
 Log::create([
    'user_id' => auth()->id(),
    'action' => 'Ombor ochirildi',
    'description' => '',
 ]);
 return redirect()->route('purchase.index')->with('success', 'Malumot ochirildi');  
}
}
