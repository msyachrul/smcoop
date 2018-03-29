<!DOCTYPE html>
<html>
<head>
  <title>Error! Halaman Tidak Ditemukan | Sistem Informasi Koperasi</title>
  @if($errors->first() == 'admin')
  	<meta http-equiv="refresh" content="0;URL='{{ URL::asset('/admin')}}'" />
  @elseif($errors->first() == 'user')
  	<meta http-equiv="refresh" content="0;URL='{{ URL::asset('/')}}'" />
  @endif
</head>
<body>	
</body>
</html>