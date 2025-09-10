<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagerController extends Controller
{
    public function index()
    {
        $managers = User::where('is_admin', true)->get();
        return view('admin.managers', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => true,
        ]);
        return redirect()->route('admin.managers.index')->with('success', 'Manager create with succes.');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return back()->with('success', 'Perfil atualizado com sucesso.');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return back()->with('error', 'You cannot remove yourself from a Manager role.');
        }
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'Manager removed.');
    }
}
