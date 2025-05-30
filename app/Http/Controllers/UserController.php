<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_type', '!=', 'admin')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:admin,teacher,student',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type' => $validated['user_type']
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'user_type' => 'required|in:admin,teacher,student',
            'course' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'academic_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'orcid' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuário excluído com sucesso.');
    }

    public function approve(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update([
            'approval_status' => 'approved'
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuário aprovado com sucesso!');
    }

    public function reject(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update([
            'approval_status' => 'rejected'
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuário rejeitado com sucesso!');
    }
}