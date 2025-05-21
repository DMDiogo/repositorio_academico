<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Mostrar o formulário de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processar a tentativa de login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    /**
     * Mostrar o formulário de registro
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Processar o registro de um novo usuário
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'user_type' => ['required', 'string', 'in:student,teacher'],
            'terms' => ['required', 'accepted'],
        ], [
            'terms.required' => 'Você deve aceitar os Termos de Serviço e Política de Privacidade.',
            'terms.accepted' => 'Você deve aceitar os Termos de Serviço e Política de Privacidade.',
            'user_type.required' => 'Você deve selecionar um tipo de usuário.',
            'user_type.in' => 'O tipo de usuário selecionado é inválido.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'approval_status' => 'pending'
        ]);

        // Criar perfil de usuário com configurações apropriadas
        UserProfile::create([
            'user_id' => $user->id,
            'department' => $user->user_type === 'admin' ? 'Administração' : null,
            'position' => $user->user_type === 'admin' ? 'Administrador do Sistema' : null,
            'bio' => $user->user_type === 'admin' ? 'Administrador responsável pela gestão e supervisão do sistema.' : null,
            'education' => $user->user_type === 'admin' ? 'Gestão de Sistemas' : null,
            'specialization' => $user->user_type === 'admin' ? 'Administração de Sistemas' : null,
            'research_areas' => $user->user_type === 'admin' ? 'Gestão de Repositórios Acadêmicos' : null,
            'office_hours' => $user->user_type === 'admin' ? 'Horário Comercial' : null,
            'contact_info' => $user->user_type === 'admin' ? 'admin@sistema.com' : null
        ]);

        return redirect()->route('login')
            ->with('success', 'Sua conta foi criada com sucesso! Aguarde a aprovação do administrador para acessar o sistema.');
    }

    /**
     * Logout do usuário
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}