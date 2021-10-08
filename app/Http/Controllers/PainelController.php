<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function index(){
        //$fullName = explode(" ", $_SESSION['name']);
        //$firstName = strtolower($fullName[0]);

        //return view('content', compact('firstName'));
        return view('content');
    }
}


