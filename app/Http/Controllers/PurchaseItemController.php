<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Purchase;
use App\Models\Medicine;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PurchaseItemController extends Controller
{

    public function index()
    {
        $purchase_items = PurchaseItem::latest()->paginate(10);
        return view('admin.purchase_items.index', compact('purchase_items'));
    }


    public function search(Request $request){
        $query = $request->get('q','');
        
        
           $total = PurchaseItem::where('batch_no', 'like', "%{$query}%")
        ->orWhereHas('medicine', fn($q) => $q->where('name', 'like', "%{$query}%"))
        ->orWhereHas('purchase', fn($q) => $q->where('purchase_no', 'like', "%{$query}%"))
        ->count();

    $purchase_items = PurchaseItem::with('purchase', 'medicine')
        ->where(function($q) use ($query){
            $q->where('batch_no', 'like', "%{$query}%")
              ->orWhereHas('medicine', fn($q) => $q->where('name', 'like', "%{$query}%"))
              ->orWhereHas('purchase', fn($q) => $q->where('purchase_no', 'like', "%{$query}%"));
        })
        ->limit(10)
        ->get();
        
        return response()->json([
            'total' => $total,
            'data' => $purchase_items,
        ]);
        
    }
    public function create()
    {
        $purchases = Purchase::all();
        $medicines = Medicine::all();

        return view('admin.purchase_items.create', compact('purchases','medicines'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'description' => 'nullable|string|max:255',
            'batch_no' => 'nullable|string|max:100',
        ]);

        try {

            DB::beginTransaction();

            $purchaseItem = PurchaseItem::create($validated);

            $medicine = Medicine::lockForUpdate()->findOrFail($validated['medicine_id']);

            $medicine->update([
                'sell_price' => $validated['sell_price'],
                'buy_price' => $validated['unit_price'],
                'expiry_date' => $validated['expiry_date'],
                'barcode' => $validated['batch_no'],
            ]);

            $medicine->increment('quantity', $validated['quantity']);

            DB::commit();
            Log::create([
            'user_id' => auth()->id(),
            'action'  => 'Omborga kelgan narsalar yangilandi',
            'description' => '',
            ]);
            return redirect()
                ->route('purchase_item.index')
                ->with('success','Dori muvaffaqiyatli kirim qilindi!');

        } catch (\Exception $e) {

            DB::rollBack();


            return back()->with('error',$e->getMessage());
        }
    }


    public function show(PurchaseItem $purchase_item)
    {
        return view('admin.purchase_items.show', compact('purchase_item'));
    }


    public function edit(PurchaseItem $purchase_item)
    {
        $purchases = Purchase::all();
        $medicines = Medicine::all();

        return view('admin.purchase_items.edit', compact(
            'purchase_item',
            'purchases',
            'medicines'
        ));
    }


    /**
     * UPDATE
     */
    public function update(Request $request, PurchaseItem $purchase_item)
    {

        $validated = $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'batch_no' => 'nullable|string|max:100',
        ]);

        try {

            DB::beginTransaction();

            $oldMedicine = Medicine::lockForUpdate()->find($purchase_item->medicine_id);

            if ($oldMedicine) {
                $oldMedicine->decrement('quantity', $purchase_item->quantity);
            }

            $purchase_item->update($validated);

            $newMedicine = Medicine::lockForUpdate()->findOrFail($validated['medicine_id']);

            $newMedicine->update([
                'buy_price' => $validated['unit_price'],
                'expiry_date' => $validated['expiry_date'],
                'barcode' => $validated['batch_no'],
            ]);

            $newMedicine->increment('quantity', $validated['quantity']);

            DB::commit();

            Log::create([
                'user_id' => auth()->id(),
                'action'  => 'ombor narsalar yangilandi ',
                'description' => '',
            ]);

            return redirect()
                ->route('purchase_item.index')
                ->with('success','Ma\'lumot yangilandi!');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error',$e->getMessage());
        }
    }


    /**
     * DELETE
     */
    public function destroy(PurchaseItem $purchase_item)
    {
        Gate::authorize('isAdmin');
        try {

            DB::beginTransaction();

            $medicine = Medicine::lockForUpdate()->find($purchase_item->medicine_id);

            if ($medicine && $medicine->quantity >= $purchase_item->quantity) {
                $medicine->decrement('quantity', $purchase_item->quantity);
            }

            $purchase_item->delete();

            DB::commit();

            Log::create([
                'user_id' => auth()->id(),
                'action'  => " ombor narsalar o'chirildi ",
                'description' => '',
            ]);

            return redirect()
                ->back()
                ->with('success','Kirim o\'chirildi!');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error',$e->getMessage());
        }
    }

}