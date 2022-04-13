<?php

namespace App\Repository;

use App\Models\Documento;
use Carbon\Carbon;


class DocumentoRepository
{
    function create(array $documentos, $idDespesa){
        $documento = new Documento();
        for ($i = 0; $i < count($documentos); $i++) {
            $documento->fk_tab_despesa_id = $idDespesa;
            $documento->fk_tipo_documento_id = $documentos[$i]['fk_tipo_documento'];
            $documento->de_documento = $documentos[$i]['de_documento'];
            $documento->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            Documento::store($documento);
        }
    }
}
