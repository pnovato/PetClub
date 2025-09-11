<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Storage;


class AdminPetController extends Controller
{
    public function index()
    {
        $availablePets = Pet::available()->where('status', 'available')->paginate(5);
        $pendingPets = Pet::where('status', 'reserved')->with('adopter')->get();
        return view('admin.pets.index', compact('availablePets', 'pendingPets'));
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
        $pet->update
        ([
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

    public function create()
    {
        return view('admin.pets.create');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return redirect()->route('admin.pets.index')->with('success', 'Pet Removed');
    }


    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        return view('admin.pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        $validated = $request->validate
        ([
            'name' => 'required|string',
            'species' => 'required|string',
            'sex' => 'required|in:male,female',
            'age_years' => 'required|numeric|min:0',
            'size' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'in:available,adopted,pending,rejected'
        ]);
        if ($request->hasFile('image')) 
            $validated['image'] = $request->file('image')->store('pets', 'public');
        $pet->update($validated);
        return redirect()->route('admin.pets.index')->with('success', 'Pet Data Updated.');
    }



    public function store(Request $request)
    {
        $validated = $request->validate
        ([
            'name' => 'required|string',
            'species' => 'required|string',
            'sex' => 'required|in:male,female',
            'age_years' => 'required|numeric|min:0',
            'size' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) 
            $validated['image'] = $request->file('image')->store('pets', 'public');
        $validated['status'] = 'available'; // pet novo começa como disponível
        Pet::create($validated);
        return redirect()->route('admin.pets.index')->with('success', 'New Pet Added.');
    }


}
