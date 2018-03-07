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
  		url: '/admin/anggota/daftar',
  		data: {
  			'_token': $('input[name=_token]').val(),
        'no': $('input[name=no]').val(),
  			'nama': $('input[name=nama]').val(),
  			'departemen': $('select[name=departemen]').val(),
  			'posisi': $('input[name=posisi]').val(),
        'totalSimpanan': $('input[name=totalSimpanan]').val(),
  		},
      // Validasi
  		success: function(data){
  			if (data.errors == 'ada') {
          toastr.error('No anggota sudah terdaftar!','Error',{timeOut:5000});
        }
        else if (data.errors) {
          toastr.error('Anggota gagal ditambahkan!','Error',{timeOut:5000});
  			}       
  			else {
  				toastr.success('Anggota berhasil ditambahkan','Success',{timeOut:5000});
          $('#daftarAnggota').modal('hide');
          setTimeout(function(){
            location.reload();
          },500);
  			}
  		},
  	});
   $('#no').val('');
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
   $('#tampilNoAnggota').val($(this).data('no'));
   $('#tampilPin').val($(this).data('pin'));
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
   $('#editPin').val($(this).data('pin'));
   $('#editNoAnggota').val($(this).data('no'));
   $('#editNama').val($(this).data('nama'));
   $('#editDepartemen').val($(this).data('departemen'));
   $('#editPosisi').val($(this).data('posisi'));
   $('#editTotalSimpanan').val($(this).data('totalsimpanan'));
 });
  // fungsi editAnggota
  $('#updateAnggota').click(function() {
    $.ajax({
      type: 'POST',
      url: '/admin/anggota/edit',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#editId').val(),
        'no': $('#editNoAnggota').val(),
        'pin': $('#editPin').val(),
        'nama': $('#editNama').val(),
        'departemen': $('#editDepartemen').val(),
        'posisi': $('#editPosisi').val(),
        'totalSimpanan': $('#editTotalSimpanan').val(),
      },
      // Validasi
      success: function(data) {
        if (data.errors) {
          toastr.error('Anggota gagal di update!','Error',{timeOut:5000});
        }
        else {
          toastr.success('Anggota berhasil di update','Success',{timeOut:5000});
          $('#editAnggota').modal('hide');
          setTimeout(function(){
            location.reload();
          },500);          
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
   $('#hapusPin').val($(this).data('pin'));
   $('#hapusNoAnggota').val($(this).data('no'));  
   $('#hapusNama').val($(this).data('nama'));
   $('#hapusDepartemen').val($(this).data('departemen'));
   $('#hapusPosisi').val($(this).data('posisi'));
   $('#hapusTotalSimpanan').val($(this).data('totalsimpanan'));
 });
  // fungsi hapusAnggota
  $('#buangAnggota').click(function() {
    $.ajax({
      type: 'POST',
      url: '/admin/anggota/hapus',
      data: {
        '_token': $('input[name=_token]').val(),
        'no': $('#hapusNoAnggota').val(),
      },
      success: function(data) {
        if (data.errors) {
          toastr.error('Anggota gagal dihapus!','Error',{timeOut:5000});
        }
        else {
          toastr.success('Anggota berhasil dihapus','Success',{timeOut:5000});
          $('#hapusAnggota').modal('hide');
          setTimeout(function(){
            location.reload();
          },500);
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
    url: '/admin/barang/daftar',
    data: {
      '_token': $('input[name=_token]').val(),
      'nama': $('input[name=nama]').val(),
      'harga': $('input[name=harga]').val(),
    },
    success: function(data) {
      if (data.errors == 'ada') {
        toastr.error('Barang sudah terdaftar!','Error',{timeOut:5000});
      }
      else if (data.errors) {
        toastr.error('Barang gagal ditambahkan!','Error',{timeOut:5000});
      }
      else {
        toastr.success('Barang berhasil ditambahkan','Success',{timeOut:5000});
        $('#daftarBarang').modal('hide');
        setTimeout(function(){
            location.reload();
          },500);
      }
    }
  });
  $('#nama').val('');
  $('#harga').val('');
 });
 // ajax tampil modal editBarang
 $(document).on('click','.editBarang',function(){
    $('#editBarang').modal('show');
    $('.modal-title').text('Edit Barang');
    $('.form-horizontal').show();
    $('#editId').val($(this).data('id'));
    $('#editNama').val($(this).data('nama'));
    $('#editHarga').val($(this).data('harga'));
 });
 // fungsi editBarang
 $('#updateBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/barang/edit',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#editId').val(),
      'nama': $('#editNama').val(),
      'harga': $('#editHarga').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal di update!','Error',{timeOut:5000});
      }
      else {
        toastr.success('Barang berhasil di update','Success',{timeOut:5000});
        $('#editBarang').modal('hide');
        setTimeout(function(){
            location.reload();
          },500);
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
    $('#hapusHarga').val($(this).data('harga'));
 });
 // fungsi hapusBarang
 $('#buangBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/barang/hapus',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#hapusId').val(),
    },
    success: function(data) {
      if (data.errors) {
        toastr.error('Barang gagal dihapus!','Error',{timeOut:5000});
      }
      else {
        toastr.success('Barang berhasil dihapus','Success',{timeOut:5000});
        $('#hapusBarang').modal('hide');
        setTimeout(function(){
            location.reload();
          },500);
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
    source: '/admin/pembelian/autocomplete',
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
      url: '/admin/pembelian/input',
      data: {
        '_token': $('input[name=_token]').val(),
        'tanggal': $('input[name=tanggal]').val(),
        'harga': $('input[name=harga]').val(),
        'kuantitas': $('input[name=kuantitas]').val(),
        'barang_id': $('input[name=barang_id]').val(),
      },
      success:function(data){
        if (data.errors == 'ada') {
          toastr.error('Data pembelian sudah ada!','Error',{timeOut:5000});
        }
        else if (data.errors) {
          toastr.error('Input pembelian gagal!','Error',{timeOut:5000});
        }
        else {
          toastr.success('Input pembelian berhasil','Success',{timeOut:5000});
          // $('#inputPembelian').modal('hide');
          setTimeout(function(){
            location.reload();
          },500);
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
    url: '/admin/pembelian/edit',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#editId').val(),
      'harga': $('#editHarga').val(),
      'kuantitas': $('#editKuantitas').val(),
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Edit pembelian gagal!','Error',{timeOut:5000});
        }
      else {
          toastr.success('Edit pembelian berhasil','Success',{timeOut:5000});
          $('#editPembelian').modal('hide');
          $('#keteranganTanggal').text('');
          setTimeout(function(){
            location.reload();
          },500);
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
    url: '/admin/pembelian/hapus',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('#hapusId').val(),      
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Hapus pembelian gagal!','Error',{timeOut:5000});
        }
      else {
          toastr.success('Hapus pembelian berhasil','Success',{timeOut:5000});
          $('#hapusPembelian').modal('hide');
          setTimeout(function(){
            location.reload();
          },500);
        }
    }
  });
 });

 // ajax tampil modal cariPembelian
 $(document).on('click','.cariPembelian',function(){
  $('#cariPembelian').modal('show');
  $('.modal-title').text('Laporan Pembelian');
  $('.form-horizontal').show();
 });
 // fungsi cariPembelian
 $('#_cariPembelian').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/pembelian/cari',
    data: {
      '_token': $('input[name=_token]').val(),
      'dariTanggal': $('input[name=dariTanggal]').val(),
      'sampaiTanggal': $('input[name=sampaiTanggal]').val(),
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Cari laporan pembelian gagal!','Error',{timeOut:5000});
      }
      else {
          toastr.success('Cari laporan pembelian berhasil','Success',{timeOut:5000});
          $('#cariPembelian').modal('hide');
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
      }
    }
  });
 });

 // Penjualan

 // ajax tampil modal cariPenjualan
 $(document).on('click','.cariPenjualan',function(){
  $('#cariPenjualan').modal('show');
  $('.modal-title').text('Cari Penjualan');
  $('.form-horziontal').show();
 });
 // BELUM BERES

 // autocomplete i_penjualanNamaAnggota
 $( '.i_penjualanNamaAnggota' ).autocomplete({
    source: '/admin/penjualan/input/anggota/autocomplete',
    select: function(event,ui) {
      event.preventDefault();
      $('.i_penjualanNamaAnggota').val(ui.item.label);
      $('.i_penjualanNoAnggota').val(ui.item.no);
      $('.i_penjualanNamaAnggota').attr('disabled','disabled');
    }
 });

 // enable i_penjualanNamaAnggota
 $('.enable_penjualanNamaAnggota').click(function(){
    $('.i_penjualanIdAnggota').val('');
    $('.i_penjualanNoAnggota').val('');
    $('.i_penjualanNamaAnggota').removeAttr('disabled').val('').focus();
 });

 // autocomplete i_penjualanNamaBarang
 $( '.i_penjualanNamaBarang' ).autocomplete({
    source: '/admin/penjualan/input/barang/autocomplete',
    select: function(event,ui) {
      event.preventDefault();
      $('.i_penjualanNamaBarang').val(ui.item.label);
      $('.i_penjualanIdBarang').val(ui.item.id);
    }
 });

 // fungsi input i_penjualanBarang
 $('#penjualanInputBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/penjualan/input/barang/tambah',
    data: {
      '_token': $('input[name=_token]').val(),
      'no': $('input[name=no]').val(),
      'barang_id': $('input[name=barang_id]').val(),
      'kuantitas': $('input[name=kuantitas]').val(),
    },
    success:function(data){
      if (data.errors) {
          toastr.error('Pilih barang terlebih dahulu!','Error',{timeOut:5000});
        }
      else {
          toastr.success('Input barang berhasil','Success',{timeOut:5000});
          $('.detailTotal').load('/admin/penjualan/input .detailTotal');
          $('#reloadTable').load('/admin/penjualan/input #barangTable');
        }
    }
  });
  $('.enable_penjualanNamaAnggota').remove();
  $('.i_penjualanIdBarang').val('');
  $('.i_penjualanNamaBarang').val('').focus();
  $('.i_penjualanKuantitas').val('1');
 });

 // fungsi batalInputPenjualan
 $('#batalInputPenjualan').click(function(){
    $.ajax({
      type: 'POST',
      url: '/admin/penjualan/input/barang/cek',
      data: {
        '_token': $('input[name=_token]').val(),
      },
      success:function(data){
        if (data < 1) {
          toastr.success('Belum ada barang yang dipilih','Success',{timeOut:5000});
        }
        else {
          let x = confirm('Hapus semua barang?');
          if (x == true) {
            $.ajax({
              type: 'POST',
              url: '/admin/penjualan/batal',
              data: {
                '_token': $('input[name=_token]').val(),
              },
              success:function(){
                toastr.success('Hapus semua barang berhasil','Success',{timeOut:5000});
              }
            });
          }
        }
        $('.detailTotal').load('/admin/penjualan/input .detailTotal');
        $('#reloadTable').load('/admin/penjualan/input #barangTable');
      }
    });
 });

 // fungsi i_penjualan
 $('.i_penjualan').click(function() {
  $.ajax({
    type: 'POST',
    url: '/admin/penjualan/input/transaksi',
    data: {
      '_token': $('input[name=_token]').val(),
      'no': $('input[name=no]').val(),
      'anggota_no': $('input[name=anggota_no]').val(),
      'tanggal': $('input[name=tanggal]').val(),
      'total': $('input[name=total]').val()
    },
    success:function(data) {
      if (data.errors == 'kosong') {
          toastr.error('Barang tidak boleh kosong!','Error',{timeOut:5000});
      }
      else if (data.errors) {
          toastr.error('Anggota belum terpilih!','Error',{timeOut:5000});
          $('.i_penjualanNamaAnggota').focus();
      }
      else {
          toastr.success('Input data penjualan berhasil','Success',{timeOut:1000});
          $('.i_penjualanNoAnggota').val('');
          $('.i_penjualanNamaAnggota').removeAttr('disabled').val('').focus();
          $('.detailTotal').load('/admin/penjualan/input .detailTotal');
          $('#reloadTable').load('/admin/penjualan/input #barangTable');
      }
    }
  });
 });

 // ajax modal hapusPenjualanBarang
 $(document).on('click','.hapusPenjualanBarang', function(){
  $('#hapusPenjualanBarang').modal('show');
  $('.modal-title').text('hapus Barang');
  $('.form-horizontal').show();
  $('.hapusPenjualanIdBarang').val($(this).data('id'));
  $('.hapusPenjualanNamaBarang').val($(this).data('nama'));
  $('.hapusPenjualanKuantitasBarang').val($(this).data('kuantitas'));
 });

 // fungsi hapusPenjualanBarang
 $('._hapusPenjualanBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/penjualan/input/barang/hapus',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('.hapusPenjualanIdBarang').val(),
      'kuantitas': $('.hapusPenjualanKuantitasBarang').val(),
    },
    success:function(data) {
      toastr.success('Barang berhasil dihapus!','Success',{timeOut:5000});
      $('#hapusPenjualanBarang').modal('hide');
      $('.detailTotal').load('/admin/penjualan/input .detailTotal');
      $('#reloadTable').load('/admin/penjualan/input #barangTable');
    }
  });
 });

 // fungsi input e_penjualanInputBarang
 $('#e_penjualanInputBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/penjualan/edit/barang/tambah',
    data: {
      '_token': $('input[name=_token]').val(),
      'no': $('input[name=no]').val(),
      'barang_id': $('input[name=barang_id]').val(),
      'kuantitas': $('input[name=kuantitas]').val(),
    },
    success:function(data){
      toastr.success('Input barang berhasil','Success',{timeOut:5000});
      $('.detailTotal').load('/admin/penjualan/edit/'+$('input[name=no]').val()+' .detailTotal');
      $('#reloadTable').load('/admin/penjualan/edit/'+$('input[name=no]').val()+' #barangTable');
    }
  });
  $('.enable_penjualanNamaAnggota').remove();
  $('.i_penjualanIdBarang').val('');
  $('.i_penjualanNamaBarang').val('').focus();
  $('.e_penjualanKuantitas').val('1');
 });

// ajax modal hapusPenjualanBarang
 $(document).on('click','.e_hapusPenjualanBarang', function(){
  $('#e_hapusPenjualanBarang').modal('show');
  $('.modal-title').text('hapus Barang');
  $('.form-horizontal').show();
  $('.hapusPenjualanIdBarang').val($(this).data('barang_id'));
  $('.hapusPenjualanNamaBarang').val($(this).data('nama'));
  $('.hapusPenjualanKuantitasBarang').val($(this).data('kuantitas'));
 });

 // fungi _e_hapusPenjualanBarang
 $('._e_hapusPenjualanBarang').click(function(){
  $.ajax({
    type: 'POST',
    url: '/admin/penjualan/edit/barang/hapus',
    data: {
      '_token': $('input[name=_token]').val(),
      'no': $('input[name=no]').val(),
      'barang_id': $('.hapusPenjualanIdBarang').val(),
    },
    success:function(data) {
      toastr.success('Barang berhasil dihapus!','Success',{timeOut:5000});
      $('#e_hapusPenjualanBarang').modal('hide');
      $('.detailTotal').load('/admin/penjualan/edit/'+$('input[name=no]').val()+' .detailTotal');
      $('#reloadTable').load('/admin/penjualan/edit/'+$('input[name=no]').val()+' #barangTable');
    }
  });
 });