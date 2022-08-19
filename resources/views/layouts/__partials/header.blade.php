<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid ">
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a href="/home" style="width: 10%; padding-right: 10px" ;>
                <img src="https://res.cloudinary.com/pedroenrick/image/upload/v1645041686/ACE-sem-fundo_lombmo.png" style="width:100%;">
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown space-item-navbar" style="padding: 10px;">
                    <a class="nav-link dropdown-toggle" href="/#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        FINANCEIRO
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="financeiro">
                        <li><a class="dropdown-item" href="{{route('despesas')}}">DESPESAS</a></li>
                        <li><a class="dropdown-item" href="{{route('extrato')}}">EXTRATO</a></li>
                        <li><a class="dropdown-item" href="{{route('fornecedores')}}">FORNECEDORES</a></li>
                        <li><a class="dropdown-item" href="{{route('lancamentos')}}">LANÇAMENTOS</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown space-item-navbar" style="padding: 10px;">
                    <a class="nav-link dropdown-toggle" href="/#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        COMPRAS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="compras">
                        <li><a class="dropdown-item" href="{{route('home')}}">HOME</a></li>
                        <li><a class="dropdown-item" href="{{route('solicitar')}}">SOLICITAR</a></li>
                        <li><a class="dropdown-item" href="{{route('total')}}">TODAS</a></li>
                    </ul>
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
                    <span>{{@SESSION('name')}}</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('logout')}}">SAIR</a></li>
                </ul>
            </li>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>

<script src="{{asset('assets/js/app.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Navbar -->
