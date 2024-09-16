<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view("auth.login");
    }

    public function authenticate(Request $request): RedirectResponse
    {

        $crendentials = $request->validate(
            [
                "email" => "required|max:100|email",
                "password" => 'required|min:3'
            ],
            [
                "email.required" => "O email é obrigatório.",
                "email.email" => "O email deve ser válido.",
                "email.max" => "O email deve conter no máximo 100 caracteres.",
                "password.required" => "A senha é obrigatória.",
                "password.min" => "A senha deve conter no mínimo 3 caracteres.",
            ]
        );

        $user = User::where("email", $crendentials["email"])
            ->where("active", true)
            ->first();

        if (!$user) {
            return back()->withInput()->with([
                "invalid_login" => "Login inválido."
            ]);
        }

        if (!password_verify($crendentials["password"], $user->password)) {
            return back()->withInput()->with([
                "invalid_login" => "Login inválido."
            ]);
        }

        $user->last_login_at = now();
        $user->save();

        $request->session()->regenerate();

        Auth::login($user);

        return redirect()->intended(route("home"));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }

    public function register(): View
    {
        return view("auth.register");
    }

    public function store_user(Request $request): RedirectResponse
    {
        $request->validate(
            [
                "name" => "required|min:10",
                "email" => "required|max:100|email|unique:users,email",
                "password" => "required|min:3",
                "password_confirmation" => "required|same:password"

            ],
            [
                "name.required" => "O nome é obrigatório.",
                "name.min" => "O nome deve conter no mínimo 10 caracteres.",

                "email.required" => "O email é obrigatório.",
                "email.email" => "O email deve ser válido.",
                "email.max" => "O email deve conter no máximo 100 caracteres.",
                "email.unique" => "O email cadastrado já existe.",

                "password.required" => "A senha é obrigatória.",
                "password.min" => "A senha deve conter no mínimo 3 caracteres.",
                "password_confirmation.required" => "A senha é obrigatória.",
                "password_confirmation.same" => "As senhas não são iguais.",
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = true;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->route("login")->with('success_message', 'Conta criada com sucesso.');;
    }
}
