<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;


class AdminPetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('adopter')->where('status', 'reserved')->paginate(5);
        return view('admin.dashboard', compact('pets'));
    }

    public function approve($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update(['status' => 'adopted']);
        return back()->with('success', 'Pet adoption approved successfully.');
    }

    public function reject($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update([
            'status' => 'available', 
            'adopted_at' => null
        ]);
        return back()->with('success', 'Pet adoption rejected.');
    }

    public function adoptions()
    {   
        $pets = Pet::with('adopter')
            ->where('status', 'adopted')
            ->whereNull('deleted_at')
            ->get();

        return view('admin.adoptions', compact('pets'));
    }
}
