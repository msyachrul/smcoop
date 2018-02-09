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
  		url: 'anggota/daftar',
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
  			if (data.errors == 'ada') {
          toastr.error('Anggota sudah terdaftar!','Error',{timeout:5000});
        }
        else if (data.errors) {
          toastr.error('Anggota gagal ditambahkan!','Error',{timeout:5000});
  			}       
  			else {
  				toastr.success('Anggota berhasil ditambahkan','Success',{timeout:5000});
          $('#daftarAnggota').modal('hide');
          $('#dataTable').load('anggota #dataTable');
  			}
  		},
  	});
   $('#noAnggota').val('');
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
      url: 'anggota/edit',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#editId').val(),
        'noAnggota': $('#editNoAnggota').val(),
        'nama': $('#editNama').val(),
        'departemen': $('#editDepartemen').val(),
        'posisi': $('#editPosisi').val(),
        'totalSimpanan': $('#editTotalSimpanan').val(),
      },
      // Validasi
      success: function(data) {
        if (data.errors) {
          toastr.error('Anggota gagal di update!','Error',{timeout:5000});
        }
        else {
          toastr.success('Anggota berhasil di update','Success',{timeout:5000});
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
      url: 'anggota/hapus',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#hapusId').val(),
      },
      success: function(data) {
        if (data.errors) {
          toastr.error('Anggota gagal dihapus!','Error',{timeout:5000});
        }
        else {
          toastr.success('Anggota berhasil dihapus','Success',{timeout:5000});
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
    url: 'barang/daftar',
    data: {
      '_token': $('input[name=_token]').val(),
      'nama': $('input[name=nama]').val(),
    },
    success: function(data) {
      if (data.errors == 'ada') {
        toastr.error('Barang sudah terdaftar!','Error',{timeout:5000});
      }
      else if (data.errors) {
        toastr.error('Barang gagal ditambahkan!','Error',{timeout:5000});
      }
      else {
        toastr.success('Barang berhasil ditambahkan','Success',{timeout:5000});
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
    url: 'barang/edit',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#editId').val(),
      'nama': $('#editNama').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal di update!','Error',{timeout:5000});
      }
      else {
        toastr.success('Barang berhasil di update','Success',{timeout:5000});
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
    url: 'barang/hapus',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#hapusId').val(),
      'nama': $('#hapusNama').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal dihapus!','Error',{timeout:5000});
      }
      else {
        toastr.success('Barang berhasil dihapus','Success',{timeout:5000});
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
 $( '.namaBarang' ).autocomplete({
    source: '/pembelian/autocomplete',
    select: function(event,ui) {
      event.preventDefault();
      $('.namaBarang').val(ui.item.label);
      $('.idBarang').val(ui.item.value);
    }
 });
 // fungsi inputPembelian
 $('#_inputPembelian').click(function(){
    $.ajax({
      type: 'POST',
      url: 'pembelian/input',
      data: {
        '_token': $('input[name=_token]').val(),
        'tanggal': $('input[name=tanggal]').val(),
        'harga': $('input[name=harga]').val(),
        'kuantitas': $('input[name=kuantitas]').val(),
        'barang_id': $('input[name=barang_id]').val(),
      },
      success:function(data){
        if (data.errors == 'ada') {
          toastr.error('Data pembelian sudah ada!','Error',{timeout:5000});
        }
        else if (data.errors) {
          toastr.error('Input pembelian gagal!','Error',{timeout:5000});
        }
        else {
          toastr.success('Input pembelian berhasil','Success',{timeout:5000});
          // $('#inputPembelian').modal('hide');
          $('#dataTable').load('pembelian #dataTable');
        }
      }
    });
    $('#barang_id').val('');
    $('#namaBarang').val('');
    $('#harga').val('');
    $('#kuantitas').val('');
 });
 // ajax tampil modal editPembelian
 $(document).on('click','.editPembelian',function(){
  $('#editPembelian').modal('show');
  $('.modal-title').text('Edit Pembelian');
  $('.form-horizontal').show();
  $('#editId').val($(this).data('id'));
  $('#editTanggal').val($(this).data('tanggal'));
  $('#editBarang_id').val($(this).data('barang_id'));
  $('#editNamaBarang').val($(this).data('nama'));
  $('#editHarga').val($(this).data('harga'));
  $('#editKuantitas').val($(this).data('kuantitas'));
 });
 // fungsi editPembelian
 $('#_editPembelian').click(function(){
  $.ajax({
    type: 'POST',
    url: 'pembelian/edit',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#editId').val(),
      'harga': $('#editHarga').val(),
      'kuantitas': $('#editKuantitas').val(),
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Edit pembelian gagal!','Error',{timeout:5000});
        }
      else {
          toastr.success('Edit pembelian berhasil','Success',{timeout:5000});
          $('#editPembelian').modal('hide');
          $('#dataTable').load('pembelian #dataTable');
      }
    }
  });
 });
 // ajax tampil modal hapusPembelian
 $(document).on('click','.hapusPembelian',function(){
  $('#hapusPembelian').modal('show');
  $('.modal-title').text('Hapus Pembelian');
  $('.form-horizontal').show();
  $('#hapusId').val($(this).data('id'));
  $('#hapusTanggal').val($(this).data('tanggal'));
  $('#hapusBarang_id').val($(this).data('barang_id'));
  $('#hapusNamaBarang').val($(this).data('nama'));
  $('#hapusHarga').val($(this).data('harga'));
  $('#hapusKuantitas').val($(this).data('kuantitas'));
 });
 // fungsi hapusPembelian
 $('#_hapusPembelian').click(function(){
  $.ajax({
    type: 'POST',
    url: 'pembelian/hapus',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#hapusId').val(),      
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Hapus pembelian gagal!','Error',{timeout:5000});
        }
      else {
          toastr.success('Hapus pembelian berhasil','Success',{timeout:5000});
          $('#hapusPembelian').modal('hide');
          $('#dataTable').load('pembelian #dataTable');
        }
    }
  });
 });

 // ajax tampil modal cariData
 $(document).on('click','.cariData',function(){
  $('#cariData').modal('show');
  $('.modal-title').text('Laporan Pembelian');
  $('.form-horizontal').show();
 });
 // fungsi cariData
 $('#_cariData').click(function(){
  $.ajax({
    type: 'POST',
    url: 'pembelian/data',
    data: {
      '_token': $('input[name=_token]').val(),
      'dariTanggal': $('input[name=dariTanggal]').val(),
      'sampaiTanggal': $('input[name=sampaiTanggal]').val(),
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Cari laporan pembelian gagal!','Error',{timeout:5000});
      }
      else {
          toastr.success('Cari laporan pembelian berhasil','Success',{timeout:5000});
          // ACAN PATI NGARTI
          $('#cariData').modal('hide');
          $('#keteranganTanggal').html('Tanggal <b>' + $('input[name=dariTanggal]').val() + '</b> sampai <b>' + $('input[name=sampaiTanggal]').val()) + '</b>';
          var html = '';
          for (var i = 0; i < data.length; i++) {
            html += '<tr>';
            html += '<td>' + (i+1) + '</td>';
            html += '<td>' + data[i].tanggal + '</td>';
            html += '<td>' + data[i].nama + '</td>';
            html += '<td class="text-right">Rp ' + data[i].harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); + '</td>';
            html += '<td class="text-right">' + data[i].kuantitas + '</td>';
            html += '<td class="text-right">Rp ' + (data[i].harga * data[i].kuantitas).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); + '</td>';
            html += '<td><a href="#" class="editPembelian btn btn-info btn-sm" data-id="' + data[i].id + '" data-tanggal="' + data[i].tanggal + '" data-nama="' + data[i].nama + '" data-harga="' + data[i].harga + '" data-kuantitas="' + data[i].kuantitas + '" data-barang_id="' + data[i].barang_id + '"><i class="fa fa-pencil"></i></a> <a href="#" class="hapusPembelian btn btn-danger btn-sm" data-id="' + data[i].id + '" data-tanggal="' + data[i].tanggal + '" data-nama="' + data[i].nama + '" data-harga="' + data[i].harga + '" data-kuantitas="' + data[i].kuantitas + '" data-barang_id="' + data[i].barang_id + '"><i class="fa fa-trash"></i></a></td>';
            html += '</tr>';
          }
          $('#tbodyCari').html(html);
          // NEPI DIEU
      }
    }
  });
 });