 // Ganti PIN
 $('#adminGantiPIN').on('submit', function(){
  event.preventDefault();
  // console.log($(this).serialize());
  $.ajax({
    type: 'POST',
    url: '/admin/ubahpin',
    data: $(this).serialize(),
    success: function(data){
      if (data.errors != null) {
        toastr.error(data.errors,'Error',{timeOut:5000});
        $('#adminGantiPIN input[name=oldPin]').focus();
      }
      else {
        toastr.success(data,'Success',{timeOut:5000});
        $('#adminGantiPIN input').val('');
        $('#pinModal').modal('hide');
      }
    },
  });
 });

 $('#userGantiPIN').on('submit', function(){
  event.preventDefault();
  // console.log($(this).serialize());
  $.ajax({
    type: 'POST',
    url: '/ubahpin',
    data: $(this).serialize(),
    success: function(data){
      if (data.errors != null) {
        toastr.error(data.errors,'Error',{timeOut:5000});
        $('#userGantiPIN input[name=oldPin]').focus();
      }
      else {
        toastr.success(data,'Success',{timeOut:5000});
        $('#userGantiPIN input').val('');
        $('#pinModal').modal('hide');
      }
    },
  });
 });

 // Anggota

 $(document).ready(function(){
  $('#anggotaTable').DataTable();
 });
 // ajax tampil modal daftarAnggota
 $(document).on('click','.daftarAnggota', function(){
   $('#daftarAnggota').modal('show');   
   $('.form-horizontal').show();
   $('.modal-title').text('Daftar Anggota');
   $('input[name=no]').val('');
   // $('input[name=pin]').val('');
   $('input[name=nama]').val('');
   $('select[name=departemen]').val('null');
   $('input[name=posisi]').val('');
   $('input[name=totalSimpanan').val('');
 });
 // focus
 $('#daftarAnggota').on('shown.bs.modal', function(){
    $('input[name=no]').focus();
 });
  // fungsi tambahAnggota
  $('#tambahAnggota').on('submit',function(){
    event.preventDefault();
    // console.log($(this).serialize());
  	$.ajax({
  		type: 'POST',
  		url: '/admin/anggota/daftar',
  		data: $(this).serialize(), 
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
   $('input').val('');
   $('select').val('null');
  });

  function showDataAnggota(param) {
   $('input[name=no]').val(param.data('no'));
   $('input[name=pin]').val(param.data('pin'));
   $('input[name=nama]').val(param.data('nama'));
   $('select[name=departemen]').val(param.data('departemen'));
   $('input[name=posisi]').val(param.data('posisi'));
   $('input[name=totalSimpanan').val(param.data('totalsimpanan'));
  };

 // ajax tampil modal tampilAnggota
 $(document).on('click','.tampilAnggota', function() {
   $('#tampilAnggota').modal('show');
   $('.form-horizontal').show();
   $('.modal-title').text('Data Anggota');
   showDataAnggota($(this));
 });
 // ajax tampil modal editAnggota
 $(document).on('click','.editAnggota', function() {
   $('#editAnggota').modal('show');
   $('.form-horizontal').show();
   $('.modal-title').text('Update Anggota');
   showDataAnggota($(this));
 });
  // fungsi editAnggota
  $('#updateAnggota').on('submit',function() {
    event.preventDefault();
    // console.log($(this).serialize());
    $.ajax({
      type: 'POST',
      url: '/admin/anggota/edit',
      data: $(this).serialize(),
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
   showDataAnggota($(this));
 });
  // fungsi hapusAnggota
  $('#deleteAnggota').on('submit',function() {
    event.preventDefault();
    // console.log($(this).serialize());
    $.ajax({
      type: 'POST',
      url: '/admin/anggota/hapus',
      data: $(this).serialize(),
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

 // Penjualan

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

  // Laporan
  $(document).on('click','._modalDetail',function(){
    $('#modalDetail').modal('show');
    $('.modal-title').text('Detail Barang Transaksi '+$(this).data('no'));
    $.ajax({
      type: 'POST',
      url: '/admin/laporan/penjualan/detail',
      data: {
        '_token': $('input[name=_token]').val(),
        'no' : $(this).data('no'),
      },
      success: function(data){
        let html = [];
        for (let i = 0; i < data.length; i++) {
          html += "<tr>";
          html += "<td>"+ data[i].nama +"</td>";
          html += "<td class='text-right'>Rp "+ data[i].harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); +"</td>";
          html += "<td class='text-right'>"+ data[i].kuantitas +"</td>";
          html += "<td class='text-right'>Rp "+ data[i].subTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); +"</td>";
          html += "</tr>";
        }
        $('.list').html(html);
      }
    });
  });

  // User Page

  // enable edit Data Anggota
  $(document).on('click','.edit',function(){
    $('input').removeAttr('disabled');
    $('select').removeAttr('disabled');
    $('.update').removeAttr('disabled');
    $('.batal').removeAttr('disabled');
    $('.edit').attr('disabled','disabled');
  });

  // Pembelian modalDetailUser
  $(document).on('click','._modalDetailUser',function(){
    $('#modalDetailUser').modal('show');
    $('.modal-title').text('Detail Barang Transaksi '+$(this).data('no'));
    $.ajax({
      type: 'POST',
      url: '/pembelian/detail',
      data: {
        '_token': $('input[name=_token]').val(),
        'no' : $(this).data('no'),
      },
      success: function(data){
        let html = [];
        for (let i = 0; i < data.length; i++) {
          html += "<tr>";
          html += "<td>"+ data[i].nama +"</td>";
          html += "<td class='text-right'>Rp "+ data[i].harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); +"</td>";
          html += "<td class='text-right'>"+ data[i].kuantitas +"</td>";
          html += "<td class='text-right'>Rp "+ data[i].subTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); +"</td>";
          html += "</tr>";
        }
        $('.list').html(html);
      },
    });
  });
