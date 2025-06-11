<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PharmacistController extends Controller
{
    public function index()
    {
        $pharmacists = User::where('role', 'pharmacist')->get();
        return view('admin.pharmacists.index', compact('pharmacists'));
    }

    public function create()
    {
        return view('admin.pharmacists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pharmacist',
        ]);

        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist created successfully.');
    }

    public function edit(User $pharmacist)
    {
        return view('admin.pharmacists.edit', compact('pharmacist'));
    }

    public function update(Request $request, User $pharmacist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pharmacist->id,
        ]);

        $pharmacist->update($validated);

        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist updated successfully.');
    }

    public function destroy(User $pharmacist)
    {
        $pharmacist->delete();
        return redirect()->route('admin.pharmacists.index')
            ->with('success', 'Pharmacist deleted successfully.');
    }
} 