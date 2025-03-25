<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function showHome()
    {
        $recentSales = DB::table('purchases')
        ->join('drugs', 'purchases.product_id', '=', 'drugs.id')
        ->select('purchases.*', 'drugs.name as drug_name')
        ->orderBy('purchases.created_at', 'desc')
        ->limit(5)
        ->get();
    


        $totalRevenue = DB::table('purchases')->sum('total_price');

        $totalPerCustomer = DB::table('purchases')
    ->select('customer_name', DB::raw('SUM(total_price) as total_spent'))
    ->groupBy('customer_name')
    ->orderByDesc('total_spent')
    ->limit(5)
    ->get();

        // Fetch top 5 drugs by quantity
        $topDrugs = DB::table('drugs')
            ->select('name', 'quantity')
            ->orderByDesc('quantity')
            ->limit(5)
            ->get();
    
            $prescriptionPurchases = DB::table('purchases')
            ->join('drugs', 'purchases.product_id', '=', 'drugs.id')
            ->where('drugs.is_prescription', true)
            ->sum('purchases.quantity');
        
        $otcPurchases = DB::table('purchases')
            ->join('drugs', 'purchases.product_id', '=', 'drugs.id')
            ->where('drugs.is_prescription', false)
            ->sum('purchases.quantity');

            $totalPurchases = $prescriptionPurchases + $otcPurchases;
        $purchasePercentages = [
            'Prescriptions' => $totalPurchases > 0 ? ($prescriptionPurchases / $totalPurchases) * 100 : 0,
            'OTC' => $totalPurchases > 0 ? ($otcPurchases / $totalPurchases) * 100 : 0,
        ];
    
        // Dashboard Data
        $recentPurchases = DB::table('purchases')->count();
        $inventoryItems = DB::table('drugs')->count();
        $drugs = DB::table('drugs')->get();
        $total = $drugs->count();
        $expired = $drugs->filter(fn($d) => Carbon::parse($d->expiry_date)->isPast())->count();
        $lowStock = $drugs->filter(fn($d) => $d->quantity <= 5)->count();
        
        $problematic = $expired + $lowStock;
        $healthScore = $total > 0 ? max(0, round(100 * (1 - $problematic / $total))) : 100;
    
        $healthQuotes = [
            "<p>Health is the greatest gift, contentment the greatest wealth, faithfulness the best relationship.</p> <span class='quoted'>- Buddha</span>",
            "<p>No matter how much it gets abused, the body can restore balance. The first rule is to stop interfering with nature.</p> <span class='quoted'>- Deepak Chopra</span>",
            "<p>He who has health has hope; and he who has hope, has everything.</p> <span class='quoted'>- Thomas Carlyle</span>",
            "<p>Health is a state of complete harmony of the body, mind, and spirit.</p> <span class='quoted'>- B.K.S. Iyengar</span>",
            "<p>Take care of your body. It's the only place you have to live in.</p> <span class='quoted'>- Jim Rohn</span>",
            "<p>It is health that is real wealth and not pieces of gold and silver.</p> <span class='quoted'>- Mahatma Gandhi</span>",
        ];
    
        $randomQuote = $healthQuotes[array_rand($healthQuotes)];
    
        return view('home', compact(
            
            'recentPurchases',
            'inventoryItems',
            'healthScore',
            'topDrugs',
            'purchasePercentages', // Pass pie chart data
            'randomQuote',
            'totalRevenue',
            'totalPerCustomer',
            'recentSales'

            
        ));
    }
}    