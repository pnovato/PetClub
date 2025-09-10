<?php
namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::available()->orderBy('created_at','desc')->get();
        return view('template.PetMember', compact('pets'));
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        return view('template.petdetails', compact('pet'));
    }

    public function adopt($id)
    {
        $pet = Pet::findOrFail($id);

        // Exemplo simples de reserva
        if ($pet->status !== 'available') {
            return back()->with('error','Este animal já não está disponível.');
        }

        $pet->update([
            'status'     => 'reserved',
            'adopted_by' => auth()->id(),
            'adopted_at' => now(),
        ]);

        return redirect()->route('pet.details', $pet->id)
            ->with('success','Pedido de adoção enviado! Entraremos em contacto.');
    }
}
