<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<figure style="left:0; top:0; ">
        <img  src="{{asset('img/ACE-sem-fundo.png')}}">
    </figure>
    <!-- Container wrapper -->
    <div class="container-fluid ">
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link " href="{{route('admin')}}">Admin</a>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('bi')}}">BI</a>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('compras')}}">Compras</a>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('compliance')}}">Compliance</a>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('contabil')}}">Contábil</a>
                </li>
                <li class="nav-item dropdown space-item-navbar" style="padding: 10px;">
                    <a class="nav-link dropdown-toggle" href="/#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Financeiro
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="financeiro">
                        <li><a class="dropdown-item" href="{{route('fornecedores')}}">Fornecedores</a></li>
                        <li><a class="dropdown-item" href="{{route('produtos')}}">Produtos</a></li>
                        <li><a class="dropdown-item" href="{{route('servicos')}}">Serviços</a></li>
                        <li><a class="dropdown-item" href="{{route('despesas')}}">Despesas</a></li>
                        <li><a class="dropdown-item" href="{{route('plano-contas')}}">Plano de contas</a></li>
                    </ul>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('rh')}}">Gestão de Pessoas</a>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('juridico')}}">Jurídico</a>
                </li>
                <li class="nav-item space-item-navbar" style="padding: 10px;">
                    <a class="nav-link" href="{{route('relatorio')}}">Relatório</a>
                </li>

            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Avatar -->
            <li class="nav-item dropdown  d-flex align-items-center hidden-arrow space-item-navbar" style="padding: 10px;">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; color:white;">
                    <i class="bi bi-person-fill"></i>
                    <span>Pedroenrick</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">My profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Sair</a></li>
                </ul>
            </li>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>

<script src="{{asset('assets/js/app.js')}}"></script>

<!-- Navbar -->