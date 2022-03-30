<?php

namespace App\Http\Controllers;

use App\Models\ProcedureLogin;
use Illuminate\Http\Request;

class LoginController extends Controller
{ //retorna view login
    public function index(Request $request)
    {
        if (session('login') !== null && session('login') != '') {
            return redirect()->route('painel');
        } else {
            $error = '';

            if ($request->get('error') == 1) {
                $error = 'Usuario e/ou senha incorretos';
            };

            if ($request->get('error') == 2) {
                $error = 'Necessário realizar login para ter acesso a página';
            };

            return view('page-login', ['error' => $error]);
        }
    }

    //retorna view esqueceu a senha
    public function forgot(Request $request)
    {
        $error = '';

        if ($request->get('error') == 1) {
            $error = 'Usuario e/ou email não existe';
        };

        return view('password', ['error' => $error]);
    }

    //recebe requisição do formulario com nome e e-mail do usuario
    public function forgotPassword(Request $request)
    {
        //regras de validação
        $rules = [
            'login' => 'required',
            'email' => 'email'
        ];

        //mensagens de feedback de validação
        $feedback = [
            'login.required' => 'O campo Login é obrigatório',
            'email.email' => 'O campo Email é obrigatório'
        ];

        //chama função de validação
        $request->validate($rules, $feedback);


        //recupera valores do usuario e transforma toda a string em lowercase
        $login = strtolower($request->get('login'));
        $email = strtolower($request->get('email'));

        //Iniciar model procedureLogin
        $procedureLogin = new ProcedureLogin($login, $email);

        if (isset($procedureLogin->login)) {
            if ($procedureLogin->login === $login && $procedureLogin->email === $email) {
                return "informações válidas";
            }
        } else {
            return redirect()->route('forgot', ['error' => 1]);
        }
        //return view('forgotPassword');
    }

    //recebe requisicao do formulario login com email e senha, e retorna sessão iniciada
    public function authentication(Request $request)
    {
        //regras de validação
        $rules = [
            'login' => 'required',
            'password' => 'required'
        ];

        //mensagens de feedback de validação
        $feedback = [
            'login.required' => 'O campo Login é obrigatório',
            'password.required' => 'O campo senha é obrigatório'
        ];

        //chama função de validação
        $request->validate($rules, $feedback);

        //recupera valores do usuario
        $login = $request->get('login');
        $password = $request->get('password');

        $procedureLogin = new ProcedureLogin($login, $password);

        if (!empty($procedureLogin->procedureResult)) {

            $credentials = explode(',', $procedureLogin->procedureResult[0]->check_login_v2);
            $credentials[0] = str_replace("(", "", $credentials[0]);
            $credentials[0] = str_replace('"', "", $credentials[0]);
            $credentials[3] = str_replace(")", "", $credentials[3]);
            //transforma em array associativo
            $result = [
                'name' => $credentials[0],
                'login' => $credentials[1],
                'password' => $credentials[2],
                'email' => $credentials[3]
            ];

            if ($result['login'] === $login && $result['password'] === $password) {
                session_start();
                session(['name' => $result['name']]);
                session(['login' => $result['login']]);

                return redirect()->route('painel');
            }
        } else {
            return redirect()->route('autenticacao', ['error' => 1]);
        }
    }

    //faz o logout do usuario
    public function logout()
    {
        if (session('name') !== null && session('login') !== null) {
            session()->forget('name');
            session()->forget('login');
            return redirect()->route('autenticacao');
        }
    }
}
