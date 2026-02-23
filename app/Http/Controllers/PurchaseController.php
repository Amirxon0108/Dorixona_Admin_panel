<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

public function index(){
    $purchases = Purchase::all();
    return view('admin.purchases.index', compact('purchases'));
}




public function create(){
    $suppliers = Supplier::all();
    $users =User::all();
return view('admin.purchases.create', compact('suppliers', 'users'));
}

public function store(Request $request){
    $validated = $request->validate([
        'supplier_id'    => 'required|exists:suppliers,id',
        'user_id'       => 'required|exists:users,id',
        'purchase_no'   => 'required|string',
        'purchase_date' => 'required|date',
        'total_amount'  => 'required|numeric',
        'description'   => 'required|string',
    ]);

    Purchase::create($validated);
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

return redirect()->route('purchase.index')->with('success', 'Malumot yangilandi ');
}


public function destroy(Purchase $purchase){
 $purchase->delete();
 return redirect()->route('purchase.index')->with('success', 'Malumot ochirildi');  
}
}
