<?php

namespace App\Http\Controllers;

use App\Models\Pix;
use Illuminate\Http\Request;

class PixController extends Controller
{
    public function showByFornecedor($id)
    {
        $pix = Pix::getPixFornecedor($id);

        return response()->json($pix);
    }
}
