<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SalesItem;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::latest()->paginate(10);
        return view('admin.sales.index', compact('sales'));
    }

    public function create()        
    {
        $medicines = Medicine::where('quantity','>',0)->get();
        return view('admin.sales.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'medicines' => 'required|array',
            'medicines.*.id' => 'required|exists:medicines,id',
            'medicines.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'discount' => 'nullable|numeric|min:0',
            'note' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $invoice = 'INV-' . time();
            $subTotal = 0;

            $sale = Sale::create([
                'user_id' => auth()->id(),
                'invoice_number' => $invoice,
                'sub_total' => 0,
                'discount' => $data['discount'] ?? 0,
                'total_amount' => 0,
                'payment_method' => $data['payment_method'],
                'status' => 'paid',
                'note' => $data['note'] ?? null,
            ]);

                foreach ($data['medicines'] as $item) {
            $medicine = Medicine::lockForUpdate()->findOrFail($item['id']);
            if ($medicine->quantity < $item['quantity']) {
                throw new \Exception($medicine->name.' yetarli emas!');
            }

            $medicine->decrement('quantity', $item['quantity']);
            $unitPrice = $medicine->sell_price;
            $quantity = $item['quantity'];
            $total = $unitPrice * $quantity;

            SalesItem::create([
                'sale_id' => $sale->id,
                'medicine_id' => $medicine->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $total
            ]);

            $subTotal += $total;
        }   

            $sale->update([
                'sub_total' => $subTotal,
                'total_amount' => $subTotal - ($data['discount'] ?? 0)
            ]);

            DB::commit();

            return redirect()->route(   'sale.index')->with('success','Savdo muvaffaqiyatli yakunlandi!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function show($id){
    $sale = Sale::with(['items.medicine','user'])->findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }

    public function downloadPdf($id){
        $sale = Sale::with(['user', 'items.medicine.category'])->findOrFail($id);
        $qr = base64_encode(
    QrCode::format('png')->size(200)->generate(
        "Invoice: ".$sale->invoice_number
    )
);
        $pdf = Pdf::loadView('admin.sales.invoice_pdf', compact('sale','qr'));
        return $pdf->download('invoice-'. $sale->invoice_number . '.pdf');
     }

     

    public function destroy($id){
        $sale = Sale::findOrFail($id);
        foreach ($sale->items as $item) {
            $medicine = Medicine::find($item->medicine_id);
            if ($medicine) {
                $medicine->increment('quantity', $item->quantity);
            }
        }
        $sale->delete();
        return redirect()->route('sale.index')->with('success','Savdo muvaffaqiyatli o\'chirildi!');

    }
}   