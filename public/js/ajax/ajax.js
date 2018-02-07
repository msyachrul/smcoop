 // Anggota

 // ajax tampil modal daftarAnggota
 $(document).on('click','.daftarAnggota', function(){
   $('#daftarAnggota').modal('show');
   $('.form-horizontal').show();
   $('.modal-title').text('Daftar Anggota');
 });
  // fungsi tambahAnggota
  $('#tambahAnggota').click(function(){
  	$.ajax({
  		type: 'POST',
  		url: 'daftarAnggota',
  		data: {
  			'_token': $('input[name=_token]').val(),
        'noAnggota': $('input[name=noAnggota').val(),
  			'nama': $('input[name=nama]').val(),
  			'departemen': $('select[name=departemen]').val(),
  			'posisi': $('input[name=posisi]').val(),
        'totalSimpanan': $('input[name=totalSimpanan]').val(),
  		},
      // Validasi
  		success: function(data){
  			if (data.errors) {
          toastr.error('Anggota gagal ditambahkan!','Error alert',{timeout:5000});
  			}
  			else {
  				toastr.success('Anggota berhasil ditambahkan','Success alert',{timeout:5000});
          $('#daftarAnggota').modal('hide');
          $('#dataTable').load('anggota #dataTable');
  			}
  		},
  	});
   $('#nama').val('');
   $('#departemen').val('null');
   $('#posisi').val('');
   $('#totalSimpanan').val('');
  });
 // ajax tampil modal tampilAnggota
 $(document).on('click','.tampilAnggota', function() {
   $('#tampilAnggota').modal('show');
   $('.form-horizontal').show();
   $('.modal-title').text('Data Anggota');
   $('#tampilId').val($(this).data('id'));
   $('#tampilnoAnggota').val($(this).data('noanggota'));
   $('#tampilNama').val($(this).data('nama'));
   $('#tampilDepartemen').val($(this).data('departemen'));
   $('#tampilPosisi').val($(this).data('posisi'));
   $('#tampilTotalSimpanan').val($(this).data('totalsimpanan'));
 });
 // ajax tampil modal editAnggota
 $(document).on('click','.editAnggota', function() {
   $('#editAnggota').modal('show');
   $('.form-horizontal').show();
   $('.modal-title').text('Update Anggota');
   $('#editId').val($(this).data('id'));  
   $('#editNoAnggota').val($(this).data('noanggota'));
   $('#editNama').val($(this).data('nama'));
   $('#editDepartemen').val($(this).data('departemen'));
   $('#editPosisi').val($(this).data('posisi'));
   $('#editTotalSimpanan').val($(this).data('totalsimpanan'));
 });
  // fungsi editAnggota
  $('#updateAnggota').click(function() {
    $.ajax({
      type: 'POST',
      url: 'editAnggota',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#editId').val(),
        'noAnggota': $('#noAnggota').val(),
        'nama': $('#editNama').val(),
        'departemen': $('#editDepartemen').val(),
        'posisi': $('#editPosisi').val(),
        'totalSimpanan': $('#editTotalSimpanan').val(),
      },
      // Validasi
      success: function(data) {
        if (data.errors) {
          toastr.error('Anggota gagal di update!','Error alert',{timeout:5000});
        }
        else {
          toastr.success('Anggota berhasil di update','Success alert',{timeout:5000});
          $('#editAnggota').modal('hide');
          $('#dataTable').load('anggota #dataTable');          
        }
      }
    });
  });
// ajax tampil modal hapusAnggota
 $(document).on('click','.hapusAnggota',function() {
   $('#hapusAnggota').modal('show');
   $('.form-horizontal').show();
   $('.modal-title').text('Hapus Anggota');
   $('#hapusId').val($(this).data('id'));
   $('#hapusNoAnggota').val($(this).data('noanggota'));  
   $('#hapusNama').val($(this).data('nama'));
   $('#hapusDepartemen').val($(this).data('departemen'));
   $('#hapusPosisi').val($(this).data('posisi'));
   $('#hapusTotalSimpanan').val($(this).data('totalsimpanan'));
 });
  // fungsi hapusAnggota
  $('#buangAnggota').click(function() {
    $.ajax({
      type: 'POST',
      url: 'hapusAnggota',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#hapusId').val(),
      },
      success: function(data) {
        if (data.errors) {
          toastr.error('Anggota gagal dihapus!','Error alert',{timeout:5000});
        }
        else {
          toastr.success('Anggota berhasil dihapus','Success alert',{timeout:5000});
          $('#hapusAnggota').modal('hide');
          $('#dataTable').load('anggota #dataTable');          
        }
      }
    });
  });

// Barang

 // ajax tampil modal tambahBarang
 $(document).on('click','.daftarBarang', function() {
    $('#daftarBarang').modal('show');
    $('.modal-title').text('Tambah Barang');
    $('.form-horizontal').show();
 });
 // fungsi tambahBarang
 $('#tambahBarang').click(function() {
  $.ajax({
    type: 'POST',
    url: 'daftarBarang',
    data: {
      '_token': $('input[name=_token]').val(),
      'nama': $('input[name=nama]').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal ditambahkan!','Error Alert',{timeout:5000});
      }
      else {
        toastr.success('Barang berhasil ditambahkan','Success Alert',{timeout:5000});
        $('#daftarBarang').modal('hide');
        $('#dataTable').load('barang #dataTable');
      }
    }
  });
  $('#nama').val('');
 });
 // ajax tampil modal editBarang
 $(document).on('click','.editBarang',function(){
    $('#editBarang').modal('show');
    $('.modal-title').text('Edit Barang');
    $('.form-horizontal').show();
    $('#editId').val($(this).data('id'));
    $('#editNama').val($(this).data('nama'));
 });
 // fungsi editBarang
 $('#updateBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: 'editBarang',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#editId').val(),
      'nama': $('#editNama').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal di update!','Error Alert',{timeout:5000});
      }
      else {
        toastr.success('Barang berhasil di update','Success Alert',{timeout:5000});
        $('#editBarang').modal('hide');
        $('#dataTable').load('barang #dataTable');
      }
    }
  });
 });
 // ajax tampil modal hapusBarang
 $(document).on('click','.hapusBarang',function(){
    $('#hapusBarang').modal('show');
    $('.modal-title').text('Hapus Barang');
    $('.form-horizontal').show();
    $('#hapusId').val($(this).data('id'));
    $('#hapusNama').val($(this).data('nama'));
 });
 // fungsi hapusBarang
 $('#buangBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: 'hapusBarang',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#hapusId').val(),
      'nama': $('#hapusNama').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal dihapus!','Error Alert',{timeout:5000});
      }
      else {
        toastr.success('Barang berhasil dihapus','Success Alert',{timeout:5000});
        $('#hapusBarang').modal('hide');
        $('#dataTable').load('barang #dataTable');        
      }
    }
  });
 });

// Pembelian

 // ajax tampil modal inputPembelian
 $(document).on('click','.inputPembelian',function(){
    $('#inputPembelian').modal('show');
    $('.modal-title').text('Input Pembelian');
    $('.form-horizontal').show();
 });
 // autocomplete namaBarang
   // $( function() {
    $( '.namaBarang' ).autocomplete({
      source: '/pembelian/autocomplete',
      select: function(event,ui) {
        event.preventDefault();
        $('.namaBarang').val(ui.item.label);
        $('.idBarang').val(ui.item.value);
      }
    });
  // });