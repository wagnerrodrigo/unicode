@extends('layouts.templates.template-login')
@section('title', 'Serviço')
@include('../layouts/__partials/header')

@section('content')
<div id="app">
    <div id="main">
        <div class="main-content container-fluid">
            <div class="page-title">
                <div class="row d-flex" style="justify-content: space-between;">
                    <div class="col-8 col-md-6 order-md-1 order-last" style="width: 33%;">
                        <h3>Fornecedor </h3>
                        <p class="text-subtitle text-muted"> <a href="https://github.com/fiduswriter/Simple-DataTables/wiki"></a>.</p>
                    </div>
                    
                    <div class="col-8 col-md-6 order-md-2 order-first" style="width: 33%;">
                        <nav aria-label="breadcrumb" class='breadcrumb-header'>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">fornecedores</li>
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
                        Lista de Fornecedor
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>CNPJ</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ramo de Atuação</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Graiden</td>
                                    <td>65.350.079/0001-26</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>38.658.977/0001-73</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>
                                    <td>New Quay</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nathaniel</td>
                                    <td>79.077.773/0001-26</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>(012165) 76278</td>
                                    <td>Grumo Appula</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Darius</td>
                                    <td>61.315.479/0001-40</td>
                                    <td>velit@nec.com</td>
                                    <td>0309 690 7871</td>
                                    <td>Ways</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oleg</td>
                                    <td>07.313.099/0001-20</td>
                                    <td>rhoncus.id@Aliquamauctorvelit.net</td>
                                    <td>0500 441046</td>
                                    <td>Rossignol</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kermit</td>
                                    <td>17.320.263/0001-80</td>
                                    <td>diam.Sed.diam@anteVivamusnon.org</td>
                                    <td>(01653) 27844</td>
                                    <td>Patna</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
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