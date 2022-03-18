@extends('layouts.templates.template')
@section('title', "produto")


@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>COMPRAS</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Registrar nova compra
                </button>
            </div>
            <div class="card-body">
                {{$compras}}
            </div>
        </div>

    </div>
</div>


@endsection

