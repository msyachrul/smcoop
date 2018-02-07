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
  <link href="template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="template/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Koperasi Marbella Suites Bandung</div>
      <div class="card-body">
        <form method="post" action="">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="noAnggota">No Anggota</label>
            <input class="form-control" name="noAnggota" id="noAnggota" type="text" placeholder="Masukan No Anggota">
          </div>
          <div class="form-group">
            <label for="noPin">PIN</label>
            <input class="form-control" name="noPin" id="noPin" type="password" placeholder="Masukan PIN Anggota">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>
<!--         <div class="text-center">
          <a class="d-block small mt-3" href="#">Daftar Sistem Informasi Koperasi</a>
          <a class="d-block small" href="#">Lupa Password?</a>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="template/vendor/jquery/jquery.min.js"></script>
  <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
