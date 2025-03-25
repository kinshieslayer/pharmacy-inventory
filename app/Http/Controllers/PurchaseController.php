<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Drug;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function showPurchase()
    {
        $products = Drug::all();
        return view('orders.purchase', ['products' => $products]);
    }

    public function handlePurchase(Request $request)
    {
        $drug = Drug::findOrFail($request->product);

        if ($request->quantity > $drug->quantity) {
            return back()->with('error', 'Not enough stock! Only ' . $drug->quantity . ' left.')->withInput();
        }

        $total_price = $drug->price * $request->quantity;

        Purchase::create([
            'customer_name' => $request->costumer_name,
            'phone_number' => $request->phone,
            'product_id' => $drug->id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        $drug->update([
            'quantity' => $drug->quantity - $request->quantity
        ]);

        return redirect()->route('showallPurchase')->with('msg', 'Purchase added successfully!');
    }

    public function showallPurchases(Request $request)
    {
        $sort = $request->input('sort', 'asc');
        $order = $request->input('order', 'total_price');

        $purchases = Purchase::with('drug')
                           ->orderBy($order, $sort)
                           ->get();

        return view('orders.all_purchases', ['purchases' => $purchases]);
    }

    public function deletePurchase($purchaseId, $prodId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $drug = Drug::findOrFail($prodId);

        $drug->update([
            'quantity' => $drug->quantity + $purchase->quantity
        ]);

        $purchase->delete();

        return back()->with('msg', 'Purchase deleted and stock restored.');
    }

    public function exportCsv()
    {
        $purchases = DB::table('purchases')->get();

        $filename = 'purchases_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'User ID', 'Drug ID', 'Quantity', 'Total Price', 'Date'];

        $callback = function() use ($purchases, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($purchases as $purchase) {
                fputcsv($file, [
                    $purchase->id,
                    $purchase->user_id ?? '-',
                    $purchase->drug_id ?? '-',
                    $purchase->quantity,
                    $purchase->total_price ?? '-',
                    $purchase->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function PurchaseSearch(Request $request)
    {
        $query = Purchase::with('drug');

        if ($request->id) {
            $query->where('id', 'like', "%$request->id%");
        }

        if ($request->customer_name) {
            $query->where('customer_name', 'like', "%$request->customer_name%");
        }

        if ($request->phone) {
            $query->where('phone_number', 'like', "%$request->phone%");
        }

        $purchases = $query->get();

        return view('orders.all_purchases', ['purchases' => $purchases]);
    }
}