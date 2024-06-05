<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request, string $type = 'admins')
    {
        $type = $request->type;
        $query = User::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $users = $query->where('role_id', 3)->paginate();

        return view('users.index', compact('users', 'type'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'lowercase',
                Rule::unique('users'),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
            'role_id' => 3,
        ]);

        return redirect()->route('users.index')->with('status', 'El cliente mayorista se ha creado correctamente.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'lowercase',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $data = $request->only('name', 'email');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        // Actualizar el usuario
        $user->update($data);

        return redirect()->route('users.index')->with('status', 'El usuario administrador se ha actualizado correctamente.');
    }

    public function destroy(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update(['status' => $request->input('status') ? 0 : 1]);

        if ($request->input('status')) {
            return to_route('users.index')->with('status', __('El usuario se ha inactivado correctamente..'));
        } else {
            return to_route('users.index')->with('status', __('El usuario se ha activado correctamente.'));
        }
    }
}
