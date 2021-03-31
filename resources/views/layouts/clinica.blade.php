<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}" />

        <title>@yield('titulo')</title>

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" type="text/css" href="{{asset('sbadmin/vendor/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('sbadmin/css/sb-admin-2.min.css')}}">
        @yield('css')

        <script src="{{asset('sbadmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <script src="{{asset('sbadmin/js/sb-admin-2.min.js')}}"></script>
        <script src="{{asset('js/libs/sweetalert2.all.js')}}?v={{time()}}"></script>
        <script src="{{asset('js/app/jquery.funcoes.clinica.js')}}?v={{time()}}"></script>
        <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="application/javascript">
            var URL_BASE = '{{URL::to("/")}}/';
            var URL_ATUAL = '{{Request::url()}}/';
        </script>
        @yield('js')
        <style>

            .loader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('http://i.imgur.com/zAD2y29.gif') 50% 50% no-repeat white;
            }

        </style>
    </head>
    <body id="page-top">
        <div id="loader" class="loader"></div>

        <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GSE</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{--route('app.admin.principal')--}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard {{$clinicas->nome_clinica}}</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>Principal</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manter:</h6>
            {{--<a class="collapse-item" href="{{route('app.admin.principal')}}">Home</a>--}}
            <a class="collapse-item" href="{{--route('app.admin.lista_admin')--}}">Processos</a>
            {{--<a class="collapse-item" href="{{route('app.admin.cliente')}}">Clientes</a>
            <a class="collapse-item" href="{{route('app.admin.plano')}}">Planos</a>
            <a class="collapse-item" href="{{route('app.admin.bares_categoria')}}">Categorias dos Bares</a>--}}
          </div>
        </div>
      </li>

      <!-- Divider -->
      {{--<hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
          <i class="fas fa-fw fa-user"></i>
          <span>Bares</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manter:</h6>
            <a class="collapse-item" href="{{route('app.admin.bares_categoria')}}">Categorias</a>
          </div>
        </div>
      </li>--}}

      <!-- Divider -->
      <!--<hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
          <i class="fas fa-fw fa-user"></i>
          <span>Restaurantes</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manter:</h6>
            <a class="collapse-item" href="{{--route('app.admin.lista_admin')--}}">Categorias</a>
          </div>
        </div>
      </li>-->

      <!-- Divider 
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
          <i class="fas fa-fw fa-cog"></i>
          <span>Convenios</span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Listar:</h6>
            <a class="collapse-item" href="{{--route('app.admin.lista_admin')--}}">Todos</a>
          </div>
        </div>
      </li>-->


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-default badge-counter">0</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alertas
                </h6>
                <a class="dropdown-item text-center small text-gray-500" href="#">Sem Alertas</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-default badge-counter">0</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Menssagens
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Sejá bem-vindo ao GSE</div>
                    <div class="small text-gray-500">{{Auth::user()->name}}</div>
                  </div>
                </a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!--<a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>-->
                <a class="dropdown-item" href="{{route('app.sair')}}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

    </div>
      <!-- End of Main Content -->




        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; GSE 2021</span>
            </div>
            </div>
        </footer>
        <!-- End of Footer -->



        <div class="modal fade" id="adicionar_pendecia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Pendencias</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                          
                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="lista_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Arquivos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        
                </div>
            </div>
        </div>
      </div>


        <!--Novo Admin Modal-->
        <div class="modal fade" id="convenioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Convenio</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user">
                            <div class="form-group row">
                                <div class="col">
                                  <select class="form-control" id="clinica">
                                    <option value="">SELECIONE A CLINICA</option>
                                      {{--@foreach ($clinicas as $clinica)
                                         <option value="{{$clinica->id_clinica}}">{{$clinica->nome_clinica}}</option>
                                      @endforeach--}}
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="nome_paciente" placeholder="NOME PACIENTE">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                <select class="form-control" id="convenio">
                                  <option>SELECIONE O CONVENIO</option>
                                  <option value="AMIL">AMIL</option>
                                  <option value="BRADESCO">BRADESCO</option>
                                  <option value="MEDSERVICE">MEDSERVICE</option>
                                  <option value="SEGURO UNIMED">SEGURO UNIMED</option>
                                  <option value="SULAMERICA">SULAMERICA</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                <select class="form-control" id="plano">
                                  <option>SELECIONE O PLANO</option>
                                  <option value="A PARTIR DE 500">A PARTIR DE 500</option>
                                  <option value="BASICO">BASICO</option>
                                  <option value="ESPECIAL 100">ESPECIAL 100</option>
                                  <option value="EXATO">EXATO</option>
                                  <option value="TODOS">TODOS</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="numero_carterinha" placeholder="Nº CARTEIRINHA">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="cpf" placeholder="CPF">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                <select class="form-control" id="tipo_envio">
                                  <option>SELECIONE O TIPO DE ENVIO</option>
                                  <option value="REEMBOLSO">REEMBOLSO</option>
                                  <option value="CIRURGIA">CIRURGIA</option>
                                  <option value="PREVIA">PREVIA</option>
                                </select>
                              </div>
                            </div>
                            <!--<div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="protocolo" placeholder="PROTOCOLO">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col">
                                  <input type="text" class="form-control" id="valor_nf" placeholder="VALOR NF">
                              </div>
                            </div>-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Reset</button>
                        <button class="btn btn-primary enviar-convenio">Enviar</button>
                    </div>
                </div>
            </div>
        </div>

         <!--Novo Categoria Bares Modal-->
         <div class="modal fade" id="baresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nova Categoria</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div id="nova_categoria">
                        <div class="modal-body">
                            <form class="user" name="form-nova-categoria">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-user" id="nome_categoria" placeholder="Nome">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Reset</button>
                            <button class="btn btn-primary enviar-categoria" onclick="enviar_categoria()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Novo Cliente Modal-->
        <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div id="novo_cliente">
                        <div class="modal-body">
                            <form class="user" name="form-nova-cliente">
                                <form class="user">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" class="form-control form-control-user" id="cliente_nome" placeholder="Nome">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="email" class="form-control form-control-user" id="cliente_email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="password" class="form-control form-control-user" id="cliente_senha" placeholder="Senha">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="password" class="form-control form-control-user" id="cliente_senha_comfirmar" placeholder="Comfirmar Senha">
                                        </div>
                                    </div>
                                </form>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Reset</button>
                            <button class="btn btn-primary" onclick="enviar_cliente()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Novo Plano Modal-->
        <div class="modal fade" id="novoPlanoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Plano</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user" name="form-nova-plano">
                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control form-control-user" id="plano_nome" placeholder="Nome do Plano">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control form-control-user" id="plano_qtd_anuncio" placeholder="Quantidade Anuncios">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control form-control-user" id="plano_qtd_meses" placeholder="Quantidade Meses">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control form-control-user" id="valor_plano" placeholder="R$ ">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Reset</button>
                            <button class="btn btn-primary" onclick="salvar_plano()">Enviar</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
