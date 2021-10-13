@extends('layouts.templates.template')
@section('title', 'Centro de custos')
@include('../layouts/__partials/header')

@section('content')
<div id="app">
    <div id="main">
        <div class="main-content container-fluid">
            <div class="page-title">
                <div class="row d-flex" style="justify-content: space-between;">
                    <div class="col-8 col-md-6 order-md-1 order-last" style="width: 33%;">
                        <h3>Centro de custo </h3>
                    </div>
                    
                    <div class="col-8 col-md-6 order-md-2 order-first" style="width: 33%;">
                        <nav aria-label="breadcrumb" class='breadcrumb-header'>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Centro de Custos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div  class="col-8 col-md-6 order-md-1 pb-3" >
                    <a class="btn btn-success">adicionar</a>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Lista de Custos
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>Empresa do grupo</th>
                                    <th>Departamento</th>
                                    <th>Carteira</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CERCRED - SOLUÇÕES DE CONTACT CENTER E RECUPERAÇÃO DE CRÉDITO LTDA.</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="modal-centro-custo"  data-bs-toggle="modal" data-bs-target="#inlineForm" class="btn icon btn-primary " style="padding: 8px 12px;"  ><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CODE AND GO DESENVOLVIMENTO DE SISTEMAS LTDA.</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-primary "><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td>COIMBRA E FERREIRA SOCIEDADE DE ADVOGADOS</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-primary "><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>GOMES DE MATTOS E COIMBRA.</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>velit@nec.com</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-primary "><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>MEDWORKER CONSULTORIA EM SAÚDE LTDA</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>rhoncus.id@Aliquamauctorvelit.net</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-primary "><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ORGANIZAÇÕES CERCRED LTDA</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>diam.Sed.diam@anteVivamusnon.org</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-primary "><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PEGA CARGA TECNOLOGIA LTDA.</td>
                                    <td>Responsavel pelo setor</td>
                                    <td>diam.Sed.diam@anteVivamusnon.org</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-primary "><i class="bi bi-pen-fill"></i></a>
                                        <a href="#" class="btn icon btn-danger "   style="padding: 8px 12px;"  ><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2020 &copy; unicode</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="http://ahmadsaugi.com"> unicode</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>





<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>
@endsection