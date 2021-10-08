@extends('layouts.templates.template')
@section('title', 'Unicode - Home')
@section('content')

<div id="app">
    <div id="main">
        <div class="main-content container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5 mt-5">
                        <a href="{{route('admin')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/admin-min_xu1ldd.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Administração</h5>
                                        <p class="card-text">
                                            Acessar módulo Administração
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5 mt-5">
                        <a href="{{route('bi')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/bi-min_cdx43o.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Business Intelligence</h5>
                                        <p class="card-text">
                                            Acessar Módulo BI
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5 mt-5">
                        <a href="{{route('compliance')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/compliance-min_ejfpei.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Compliance</h5>
                                        <p class="card-text">
                                            Acessar Módulo Compliance
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('compras')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145575/compras-min_aqooub.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Compras</h5>
                                        <p class="card-text">
                                            Acessar Módulo Compras
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('contabil')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145575/contabil-min_aj3ccn.jpg" style="width: 100%; height: 415px;" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Contábil</h5>
                                        <p class="card-text">
                                            Acessar Módulo Contábil
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('financeiro')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/financeiro-min_mueif7.jpg" style="width: 100%; height: 415px;" class="card-img-top img-fluid" alt="singleminded">
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

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('juridico')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/juridico-min_zazmgi.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Jurídico</h5>
                                        <p class="card-text">
                                            Acessar Módulo Jurídico
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('relatorio')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/relatorios-min_bm2am9.jpg" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Relatório</h5>
                                        <p class="card-text">
                                            Acessar Módulo Relatório
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6 col-sm-12 mb-5">
                        <a href="{{route('rh')}}">
                            <div class="card">
                                <div class="card-content">
                                    <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1632145576/rh-min_tjbruh.jpg" style="width: 100%; height: 415px;" class="card-img-top img-fluid" alt="singleminded">
                                    <div class="card-body">
                                        <h5 class="card-title">Gestão de Pessoas</h5>
                                        <p class="card-text">
                                            Acessar Módulo Gestão de Pessoas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

@endsection
