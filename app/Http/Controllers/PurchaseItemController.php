<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Purchase;
use App\Models\Medicine;
use Illuminate\Http\Request;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $purchase_items = PurchaseItem::all();
        return view('admin.purchase_items.index', compact('purchase_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases=Purchase::all();
        $medicines = Medicine::all();
        return view('admin.purchase_items.create', compact('medicines','purchases'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request) 
{
    // 1. Purchase (Hujjat) yaratish
    $purchase = Purchase::create([
        'supplier_id' => $request->supplier_id,
        'purchase_no' => 'INV-' . time(),
        'total_amount' => $request->total_amount,
        'purchase_ddate' => $request->purchasef_date,
    ]);

    // 2. Har bir dori uchun PurchaseItem yaratish va Medicine qoldig'ini yangilash
    foreach ($request->items as $item) {
        // Purchase_items ga yozish
        $purchase->items()->create([
            'medicine_id' => $item['medicine_id'],
            'quantity'    => $item['quantity'],
            'unit_price'  => $item['unit_price'],
        ]);

        // ENG MUHIMI: Medicines jadvalidagi qoldiqni oshirish
        $medicine = Medicine::find($item['medicine_id']);
        $medicine->increment('quantity', $item['quantity']);
        
        // Agar stock_logs jadvalingiz bo'lsa, unga ham yozish:
        StockLog::create([
            'medicine_id' => $item['medicine_id'],
            'quantity'    => $item['quantity'],
            'type'        => 'in',
            'note'        => "Kirim: " . $purchase->purchase_no
        ]);
    }

    return redirect()->route('purchases.index')->with('success', 'Kirim muvaffaqiyatli bajarildi!');
}

    /**
     * Display the specified resource.
     */
    public function show(PurchaseItem $purchase_item)
              
    {
         $purchases=Purchase::all();
        $medicines = Medicine::all();
        return view('admin.purchase_items.create', compact('medicines','purchases'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.purchase_items.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseItem $purchase_item)
    {
        $purchase_item->delete();
        return redirect()->route('purchase_items.index')->with('success', 'Kirim o\'chirildi!');
    }
}
