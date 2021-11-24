<?php

namespace App\Http\Controllers;

use App\Models\ClassificacaoContabil;
use Illuminate\Http\Request;

class ClassificacaoContabilController extends Controller
{
    public function index()
    {
        $classificacaoContabil = ClassificacaoContabil::selectAll();

        return response()->json($classificacaoContabil);
    }
}
