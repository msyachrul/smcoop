<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Koperasi Marbella Suites Bandung</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ URL::asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ URL::asset('template/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ URL::asset('template/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('template/css/sb-admin.css') }}" rel="stylesheet">
  <!-- toastr Notification -->
  <link href="{{ URL::asset('toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ URL::asset('js/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet"  />

  <style type="text/css">
    .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">Sistem Informasi Koperasi</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <?php $sesi = session('data') ?>
        @if($sesi['admin'] == true)
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ URL::asset('/admin/') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Anggota">
          <a class="nav-link" href="{{ URL::asset('/admin/anggota') }}">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Anggota</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventory">
          <a class="nav-link" href="{{ URL::asset('/admin/barang') }}">
            <i class="fa fa-fw fa-suitcase"></i>
            <span class="nav-link-text">Barang</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventory">
          <a class="nav-link" href="{{ URL::asset('/admin/penjualan') }}">
            <i class="fa fa-fw fa-shopping-basket"></i>
            <span class="nav-link-text">Penjualan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Laporan">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseLaporan" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseLaporan">
            <li>
              <a href="{{ URL::asset('/admin/laporan/penjualan' )}}">Penjualan</a>
            </li>
          </ul>
        </li>        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">#</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">#</span>
          </a>
        </li>
        @else
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ URL::asset('/') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventory">
          <a class="nav-link" href="{{ URL::asset('/pembelian') }}">
            <i class="fa fa-fw fa-shopping-cart"></i>
            <span class="nav-link-text">Pembelian</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tagihan">
          <a class="nav-link" href="{{ URL::asset('tagihan') }}">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Tagihan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pengajuan">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Pengajuan</span>
          </a>
        </li>
        @endif
      </ul>      
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <div class="dropdown">
          @if ($sesi['admin'] == true)
          <a class="nav-link dropdown-toggle" data-toggle="dropdown">Administrator | <b>{{ $sesi['nama'] }}</b></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <a href="{{ URL::asset('admin/profile') }}"><li class="dropdown-item"><i class="fa fa-fw fa-user"></i>Profil</li></a>
          @else
          <a class="nav-link dropdown-toggle" data-toggle="dropdown">Pengguna | <b>{{ $sesi['nama'] }}</b></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <a href="{{ URL::asset('/profile') }}"><li class="dropdown-item"><i class="fa fa-fw fa-user"></i>Profil</li></a>
          @endif
            <a href="#" data-toggle="modal" data-target="#pinModal"><li class="dropdown-item"><i class="fa fa-fw fa-gear"></i>Ganti PIN</li></a>
            <a href="#" data-toggle="modal" data-target="#logoutModal"><li class="dropdown-item"><i class="fa fa-fw fa-sign-out"></i>Keluar</li></a>
          </ul>          
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          @yield('breadcrumb')
        </li>
      </ol>
      <!-- Content -->
      @yield('content')
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Sistem Informasi Koperasi 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Ganti PIN Modal -->
    <div class="modal fade" id="pinModal" role="dialog">
      @if ($sesi['admin'] == true)
      <form id="adminGantiPIN">
      @else
      <form id="userGantiPIN">
      @endif
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ganti PIN</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="control-label col-sm">PIN Lama</label>
                <input type="password" class="form-control" name="oldPin" placeholder="PIN Lama" required autofocus>
              </div>
              <div class="form-group">
                <label class="control-label col-sm">PIN Baru</label>
                <input type="password" class="form-control" name="newPin" placeholder="PIN Baru" required>
              </div>
              <div class="form-group">
                <label class="control-label col-sm">Konfirmasi PIN Baru</label>
                <input type="password" class="form-control" name="confirmPin" placeholder="PIN Konfirmasi" required>
              </div>
              <div class="form-group">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">Ubah</button>
                  <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Ada yakin ingin keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih <b>"Keluar"</b> jika anda yakin.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="{{ URL::asset('keluar') }}">Keluar</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ URL::asset('template/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('template/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('template/js/sb-admin.min.js') }}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ URL::asset('template/js/sb-admin-datatables.min.js') }}"></script>
    <!-- toastr Notification -->
    <script src="{{ URL::asset('toastr/toastr.min.js') }}"></script>

    <script src="{{ URL::asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Ajax -->
    <script src="{{ URL::asset('js/ajax/ajax.js') }}"></script>
    <!-- Popup toastr after event -->
    @if(isset($info))
      <script type="text/javascript">
        toastr.{{$info['result']}}("{{$info['ket']}}","{{ucwords($info['result'])}}");
      </script>
    @endif
  </div>
</body>

</html>
