<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Purchase;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $purchase_items = PurchaseItem::latest()->paginate(10);
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
    
    $validated = $request->validate([
        'purchase_id'  => 'required|exists:purchases,id',
        'medicine_id'  => 'required|exists:medicines,id',
        'quantity'     => 'required|integer|min:1',
        'unit_price'   => 'required|numeric|min:0',
        'expiry_date'  => 'nullable|date',
        'description'  => 'nullable|string|max:255',
        'batch_no'     => 'nullable|string|max:100',
    ]);

    try {
       
        DB::beginTransaction();

        
        $purchaseItem = PurchaseItem::create($validated);

        
        $medicine = Medicine::findOrFail($request->medicine_id);
        

       $medicine->update([
            'buy_price' => $request->unit_price,
            'expiry_date' => $request->expiry_date,
            'barcode'    => $request->batch_no,
       ]);
     
        $medicine->increment('quantity', $request->quantity);
    
        DB::commit();

        return redirect()->route('purchase_item.index')
                         ->with('success', 'Dori muvaffaqiyatli kirim qilindi va ombor yangilandi!');

    } catch (\Exception $e) {
     
        DB::rollBack();
        
        return back()->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(PurchaseItem $purchase_item)
              
    {
        return view('admin.purchase_items.show', compact('purchase_item'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseItem $purchase_item)
    {
        $medicines = Medicine::all();
        $purchases =Purchase::all();
        return view('admin.purchase_items.edit', compact('purchase_item', 'medicines','purchases'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, PurchaseItem $purchase_item)
{
    $validated = $request->validate([
        'purchase_id'  => 'required|exists:purchases,id',
        'medicine_id'  => 'required|exists:medicines,id',
        'quantity'     => 'required|integer|min:1',
        'unit_price'   => 'required|numeric|min:0',
        'expiry_date'  => 'nullable|date',
        'batch_no'     => 'nullable|string|max:100',
    ]);

    try {
        DB::beginTransaction();

        // 1. Eski dori qoldig'ini qaytadan hisoblaymiz
        $old_medicine = Medicine::find($purchase_item->medicine_id);
        // Avvalgi miqdorni ombordan ayiramiz (go'yo o'sha kirim bo'lmagandek)
        $old_medicine->decrement('quantity', $purchase_item->quantity);

        // 2. Yangi ma'lumotlarni saqlaymiz
        $purchase_item->update($validated);

        // 3. Yangi (tahrirlangan) dori va miqdorni topamiz
        $new_medicine = Medicine::find($request->medicine_id);
        // Yangi miqdorni omborga qo'shamiz
        $new_medicine->increment('quantity', $request->quantity);

        

        DB::commit();
        return redirect()->route('purchase_item.index')->with('success', 'Ma\'lumotlar yangilandi va ombor qayta hisoblandi!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Xatolik: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseItem $purchase_item)
{
    try {
        DB::beginTransaction();

        // 1. Ombordagi dori qoldig'ini topamiz
        $medicine = Medicine::find($purchase_item->medicine_id);

        if ($medicine) {
            // 2. O'chirilayotgan kirim miqdorini ombordan ayiramiz
            $medicine->decrement('quantity', $purchase_item->quantity);
            
            
        }

        // 4. Endi bazadan kirimni o'chirsak bo'ladi
        $purchase_item->delete();

        DB::commit();
        return redirect()->back()->with('success', "Kirim o'chirildi va ombor qoldig'i qayta hisoblandi!");

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', "Xatolik yuz berdi: " . $e->getMessage());
    }
}
}
