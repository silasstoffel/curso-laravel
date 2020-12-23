<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{

    public function index()
    {
        return view('entrar.index', ['mensagem' => null]);
    }

    public function entrar(Request $request)
    {
        $form = $request->only(['email', 'password']);
        if (!Auth::attempt($form)) {
            return redirect()
            ->back()
            ->withErrors('Usuário ou senha inválidos!');
        }
        return redirect()->route('serie.index');
    }

}
