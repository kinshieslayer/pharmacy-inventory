<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Drug;

class DrugsController extends Controller
{
    public function showAddDrug()
    {
        return view('drugs.add_drug');
    }

    public function handleAddDrug(Request $request)
    {
        Drug::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'prescription_required' => $request->prescription_required,
        ]);

        return redirect()->route('showAllDrugs');
    }

    public function showAllDrugs(Request $request)
    {
        $query = Drug::query();
    
        // Check if a sorting parameter exists
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $drugs = $query->orderBy('price', 'asc')->get();
            } elseif ($request->sort == 'price_desc') {
                $drugs = $query->orderBy('price', 'desc')->get();
            } else {
                $drugs = $query->get(); // No sorting applied
            }
        } else {
            $drugs = $query->get(); // No sorting applied
        }
    
        return view('drugs.all_drugs', compact('drugs'));
    }
                

    public function showDrug($id)
    {
        $drug = Drug::findOrFail($id);
        return view('drugs.show_drug', ['drugs' => $drug]);
    }

    public function showUpdateDrug($id)
    {
        $drug = Drug::findOrFail($id);
        return view('drugs.update_drug', compact('drug')); // <-- Corrected to 'drug'
    }
    
    public function handleUpdateDrug(Request $request, $id)
    {
        $drug = Drug::findOrFail($id);

        $drug->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'prescription_required' => $request->prescription_required,
        ]);

        return redirect()->route('showAllDrugs');
    }

    public function deleteDrug($id)
    {
        $drug = Drug::findOrFail($id);
        $drug->delete();
        return redirect()->route('showAllDrugs')->with('msg', 'Drug deleted successfully!');
    }
        
    public function DrugsSearch(Request $request)
    {
        // Initialize query to fetch drugs
        $query = Drug::query();

        // Search by drug ID
        if ($request->id) {
            $query->where('id', 'like', "%$request->id%");
        }

        // Search by drug name
        if ($request->name) {
            $query->where('name', 'like', "%$request->name%");
        }

        // Search by drug description
        if ($request->description) {
            $query->where('description', 'like', "%$request->description%");
        }

        // Search by drug quantity
        if ($request->quantity) {
            $query->where('quantity', 'like', "%$request->quantity%");
        }

        // Get the results
        $drugs = $query->get();

        // Return the view with search results
        return view('drugs.all_drugs', ['drugs' => $drugs]);
    }

    public function exportCsv()
    {
        // Fetch all drugs
        $drugs = DB::table('drugs')->get();

        // Define the filename for the CSV
        $filename = 'drugs_' . now()->format('Ymd_His') . '.csv';

        // Set the headers for the CSV file
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Define the columns for the CSV header
        $columns = ['ID', 'Name', 'Description', 'Quantity', 'Price', 'Expiry Date'];

        // Callback function to generate CSV
        $callback = function() use ($drugs, $columns) {
            // Open the output file
            $file = fopen('php://output', 'w');

            // Insert header into the CSV
            fputcsv($file, $columns);

            // Loop through the drugs and insert them into the CSV
            foreach ($drugs as $drug) {
                fputcsv($file, [
                    $drug->id,
                    $drug->name,
                    $drug->description,
                    $drug->quantity,
                    $drug->price,
                    $drug->expiry_date,
                ]);
            }

            // Close the file
            fclose($file);
        };

        // Return the response with CSV headers and content
        return response()->stream($callback, 200, $headers);
    }
}