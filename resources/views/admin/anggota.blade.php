@extends('layouts.layout')

@section('breadcrumb','Anggota')

@section('content')
	<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Anggota 
      	</div>
        <div class="card-body">
          <div class="table-responsive" id="reloadTable">
            <table class="table table-bordered" id="anggotaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="20#">No Anggota</th>
                  <th width="30%">Nama</th>
                  <th width="30%">Tanggal Bergabung</th>
                  <th class="text-center" width="15%">
                    <a href="#" class="daftarAnggota btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                  </th>
                </tr>
              </thead>
              {{ csrf_field() }}
              <tbody>
                <?php $i=1; ?>
                @foreach($anggota as $key => $value)
                <tr class="anggota{{ $value->id }}">
                	<td>{{ $i++ }}</td>
              		<td>{{ $value->no }}</td>
              		<td>{{ $value->nama }}</td>
                  <td>{{ $value->tanggal_bergabung }}</td>
                  <!-- Trigger Modal -->
                  <td class="text-center">
                    <a href="#" class="tampilAnggota btn btn-success btn-sm" data-no="{{ $value->no }}" data-pin="{{ $value->pin }}" data-nama="{{ $value->nama }}" data-departemen="{{ $value->departemen }}" data-posisi="{{ $value->posisi }}" data-tanggalbergabung="{{ $value->tanggal_bergabung }}"><i class="fa fa-eye"></i></a>
                    <a href="#" class="editAnggota btn btn-info btn-sm" data-no="{{ $value->no }}" data-pin="{{ $value->pin }}" data-nama="{{ $value->nama }}" data-departemen="{{ $value->departemen }}" data-posisi="{{ $value->posisi }}" data-tanggalbergabung="{{ $value->tanggal_bergabung }}"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="hapusAnggota btn btn-danger btn-sm" data-no="{{ $value->no }}" data-pin="{{ $value->pin }}" data-nama="{{ $value->nama }}" data-departemen="{{ $value->departemen }}" data-posisi="{{ $value->posisi }}" data-tanggalbergabung="{{ $value->tanggal_bergabung }}"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
     </div>

          <!-- Modal daftarAnggota -->
          <div id="daftarAnggota" class="modal fade" role="dialog">
            <form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('/admin/anggota/daftar')}}">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    {{ csrf_field() }}
                    <input type="text" class="form-control" name="no" placeholder="No Anggota" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Anggota" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Departemen</label>
                    <select class="form-control" name="departemen" required>
                      <option value="null" disabled selected hidden>Posisi  Departemen</option>
                      <option value="A & G">A & G</option>
                      <option value="Accounting">Accounting</option>
                      <option value="Engineering">Engineering</option>
                      <option value="Food & Beverage">Food & Beverage</option>
                      <option value="Human Resource">Human Resource</option>
                      <option value="Housekeeping">Housekeeping</option>
                      <option value="Sales & Marketing">Sales & Marketing</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Posisi</label>
                    <input type="text" class="form-control" name="posisi" placeholder="Posisi Pekerjaan" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8">Tanggal Bergabung</label>
                    <input type="text" class="form-control" name="tanggalBergabung" placeholder="YYYY-MM-DD">
                  </div>
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    <span class="fa fa-plus"></span> Daftar
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Batal
                  </button>
                  </div>
              </div>
            </div>
            </form>
          </div>
          <!-- Modal tampilAnggota -->
          <div id="tampilAnggota" class="modal fade" role="dialog">
            <form class="form-horizontal" role="form">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    <input type="text" class="form-control" name="no" placeholder="No Anggota" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm">PIN</label>
                    <input type="text" class="form-control" name="pin" placeholder="Kode PIN" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Anggota" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Departemen</label>
                    <select class="form-control" name="departemen" disabled>
                      <option value="null" disabled selected hidden>Posisi  Departemen</option>
                      <option value="A & G">A & G</option>
                      <option value="Accounting">Accounting</option>
                      <option value="Engineering">Engineering</option>
                      <option value="Food & Beverage">Food & Beverage</option>
                      <option value="Human Resource">Human Resource</option>
                      <option value="Housekeeping">Housekeeping</option>
                      <option value="Sales & Marketing">Sales & Marketing</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Posisi</label>
                    <input type="text" class="form-control" name="posisi" placeholder="Posisi Pekerjaan" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8">Tanggal Bergabung</label>
                    <input type="text" class="form-control" name="tanggalBergabung" placeholder="YYYY-MM-DD" disabled>
                  </div>
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Tutup
                  </button>
                  </div>
              </div>
            </div>
            </form>
          </div>
          <!-- Modal editAnggota -->
          <div id="editAnggota" class="modal fade" role="dialog">
            <form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('/admin/anggota/edit')}}">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    {{ csrf_field() }}
                    <input type="text" class="form-control" name="no" placeholder="No Anggota" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm">PIN</label>
                    <input type="text" class="form-control" name="pin" placeholder="Kode PIN" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Anggota" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Departemen</label>
                    <select class="form-control" name="departemen" required>
                      <option value="null" disabled selected hidden>Posisi  Departemen</option>
                      <option value="A & G">A & G</option>
                      <option value="Accounting">Accounting</option>
                      <option value="Engineering">Engineering</option>
                      <option value="Food & Beverage">Food & Beverage</option>
                      <option value="Human Resource">Human Resource</option>
                      <option value="Housekeeping">Housekeeping</option>
                      <option value="Sales & Marketing">Sales & Marketing</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Posisi</label>
                    <input type="text" class="form-control" name="posisi" placeholder="Posisi Pekerjaan" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8">Tanggal Bergabung</label>
                    <input type="text" class="form-control" name="tanggalBergabung" placeholder="YYYY-MM-DD">
                  </div>
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-info">
                    <span class="fa fa-pencil"></span> Update
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Batal
                  </button>
                  </div>
              </div>
            </div>
            </form>
          </div>
          <!-- Modal hapusAnggota -->
          <div id="hapusAnggota" class="modal fade" role="dialog">
            <form class="form-horizontal" role="form" method="POST" action="{{ URL::asset('/admin/anggota/hapus')}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label col-sm-12 text-center"><b>Apakah anda yakin menghapus anggota ini?</b></label>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    {{ csrf_field() }}
                    <input type="text" class="form-control" name="no" placeholder="No Anggota" readonly>
                  </div>              
                  <div class="form-group">
                    <label class="control-label col-sm-2">Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Anggota" readonly>
                  </div>               
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">
                    <span class="fa fa-trash"></span> Hapus
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Batal
                  </button>
                  </div>
              </div>
            </div>
            </form>
          </div>
@endsection