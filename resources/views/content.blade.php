@extends('layouts.templates.template')
@section('title', 'ACE Intranet - Home')
@section('content')

<div id="app">
    <div id="main">
        <div class="main-content container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('financeiro')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1644432226/financeiro.jpg" style="width: 100%; height: 415px;" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Financeiro</h5>
                                        <p class="card-text">
                                            Acessar Módulo Financeiro
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('compras')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145575/compras-min_aqooub.jpg" style="width: 100%; height: 415px;" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">COMPRAS</h5>
                                        <p class="card-text">
                                            Acessar Módulo Compras
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/vendors.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

@endsection
