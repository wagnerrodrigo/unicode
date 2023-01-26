<?php

namespace App\Http\Controllers\Politicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Politicas\Politicas;
use Carbon\Carbon;

class AddPoliticaController extends Controller
{
    public function index()
    {
        
        return view('admin.politicas.addPolitica');
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'salvarImagem'         => 'mimes:jpeg,png,jpg,docx,pdf|max:5000',
        ]);

        if ($request->hasFile('salvarImagem')) {

            // Pega o nome completo com extensao
            $filenameWithExt = $request->file('salvarImagem')->getClientOriginalName();
            // Pega so o nome
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Pega so a extensao
            $extension = $request->file('salvarImagem')->getClientOriginalExtension();
            // Altera o nome
            $nomeRG = $filename . '_' . time() . '.' . $extension;
            // Fz o Upload do arquivo
            $path = $request->file('salvarImagem')->storeAs('salvarImagem/', $nomeRG);
        }




        $politica = new Politicas();
        $politica->remetente                  = $request->nome;
        $politica->titulo_politica            = $request->titulo;
        $politica->politica                   = $request->politica;
        $politica->fk_tab_empregado_id        = null;
        $politica->fk_tab_arquivo_politica_id = null;
        $politica->data_cadastro              = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        
        $politica->salvarPolitica($politica);

        return redirect()->route('homePoliticas')->with('success', 'Politica Salva.');
      
    }
}
