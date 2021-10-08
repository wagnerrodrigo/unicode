<?php

namespace App\Http\Controllers;
use Error;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ProcedureLogin;
use Illuminate\Http\Request;

class LoginController extends Controller
{   //retorna view login
    public function index(Request $request)
    {
        $error = '';

        if ($request->get('error') == 1) {
            $error = 'Usuario e/ou senha incorretos';
        };

        if ($request->get('error') == 2) {
            $error = 'Necessário realizar login para ter acesso a página';
        };

        return view('page-login', ['error' => $error]);
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
            'cpf' => 'required',
            'email' => 'email'
        ];

        //mensagens de feedback de validação
        $feedback = [
            'cpf.required' => 'O campo CPF é obrigatório',
            'email.email' => 'O campo Email é obrigatório'
        ];

        //chama função de validação
        $request->validate($rules, $feedback);


        //recupera valores do usuario e transforma toda a string em lowercase
        $cpf = strtolower($request->get('cpf'));
        $email = strtolower($request->get('email'));

        //Iniciar model User
        $user = new ProcedureLogin($cpf, $email);

        if (isset($user->cpf)) {
            if ($user->cpf === $cpf && $user->email === $email) {
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
            'cpf' => 'required',
            'password' => 'required'
        ];

        //mensagens de feedback de validação
        $feedback = [
            'cpf.required' => 'O campo CPF é obrigatório',
            'password.required' => 'O campo senha é obrigatório'
        ];

        //chama função de validação
        $request->validate($rules, $feedback);

        //recupera valores do usuario
        $cpf = $request->get('cpf');
        $password = $request->get('password');

        $user = new ProcedureLogin($cpf, $password);

        if (isset($user->procedureResult)) {
            $result = $user->procedureResult;

            if ($result->login === $cpf && $result->senha === $password) {
                session_start();
                $_SESSION['name'] = $result->nome;
                $_SESSION['cpf'] = $result->login;

                return redirect()->route('painel');
            }
        } else {
            return redirect()->route('autenticacao', ['error' => 1]);
        }
    }

    //faz o logout do usuario
    public function logout()
    {
        if (isset($_SESSION))
            session_destroy();
        return redirect()->route('autenticacao');
    }
}
