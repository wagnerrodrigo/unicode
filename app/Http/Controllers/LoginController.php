<?php

namespace App\Http\Controllers;
use Error;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Http\Middleware\UserAuthenticate;
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

        //Iniciar model User
        $user = new ProcedureLogin($login, $email);

        if (isset($user->login)) {
            if ($user->login === $login && $user->email === $email) {
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

        $user = new ProcedureLogin($login, $password);

        if (!empty($user->procedureResult)) {

            dd($user->procedureResult[0])->check_;
            $credentials = explode(',', $user->procedureResult[0]);
            $credentials[0] = str_replace("(", "", $credentials[0]);
            $credentials[0] = str_replace('"', "", $credentials[0]);
            $credentials[3] = str_replace(")", "", $credentials[3]);

            // foreach ($procedure as $proc) {
            //     $this->procedureResult = $proc;
            // }

            //transforma em array associativo
            $this->procedureResult = [
                'name' => $credentials[0],
                'login' => $credentials[1],
                'password' => $credentials[2],
                'email' => $credentials[3]
            ];

            $result = $user->procedureResult;

            dd($result);


            new UserAuthenticate($result['login'], $result['password']);

            //dd($_SESSION);

            // if ($result['login'] === $login && $result['password'] === $password) {
            //     session_start();
            //     $_SESSION['name'] = $result['name'];
            //     $_SESSION['login'] = $result['login'];

            return redirect()->route('painel');
            // }
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
