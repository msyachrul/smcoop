@extends('layouts.layout')

@section('breadcrumb','Anggota')

@section('content')

	<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Anggota 
      	</div>
        <div class="card-body">
          <div class="table-responsive" id="reloadTable">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="20#">No Anggota</th>
                  <th width="30%">Nama</th>
                  <th width="30%">Total Simpanan</th>
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
                  <td>Rp <?php echo number_format($value->totalSimpanan); ?></td>
                  <!-- Trigger Modal -->
                  <td class="text-center">
                    <a href="#" class="tampilAnggota btn btn-success btn-sm" data-no="{{ $value->no }}" data-nama="{{ $value->nama }}" data-departemen="{{ $value->departemen }}" data-posisi="{{ $value->posisi }}" data-totalsimpanan="{{ $value->totalSimpanan }}"><i class="fa fa-eye"></i></a>
                    <a href="#" class="editAnggota btn btn-info btn-sm" data-no="{{ $value->no }}" data-nama="{{ $value->nama }}" data-departemen="{{ $value->departemen }}" data-posisi="{{ $value->posisi }}" data-totalsimpanan="{{ $value->totalSimpanan }}"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="hapusAnggota btn btn-danger btn-sm" data-no="{{ $value->no }}" data-nama="{{ $value->nama }}" data-departemen="{{ $value->departemen }}" data-posisi="{{ $value->posisi }}" data-totalsimpanan="{{ $value->totalSimpanan }}"><i class="fa fa-trash"></i></a>
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
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    <input type="text" class="form-control" name="no" id="no" placeholder="No Anggota" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anggota" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="departemen">Departemen</label>
                    <select class="form-control" name="departemen" id="departemen" required>
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
                    <label class="control-label col-sm-2" for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Posisi Pekerjaan" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8" for="totalSimpanan">Total Simpanan</label>
                    <input type="number" class="form-control" name="totalSimpanan" id="totalSimpanan" placeholder="Total Simpanan">
                  </div>
                  </form>                  
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="tambahAnggota">
                    <span class="fa fa-plus"></span> Daftar
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Batal
                  </button>
                  </div>
              </div>
            </div>
          </div>
          <!-- Modal tampilAnggota -->
          <div id="tampilAnggota" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form">
                    <input type="hidden" name="id" id="tampilId" disabled>
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    <input type="text" class="form-control" name="no" id="tampilNoAnggota" placeholder="No Anggota" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="tampilNama">Nama</label>
                    <input type="text" class="form-control" id="tampilNama" name="nama" placeholder="Nama Anggota" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="tampilDepartemen">Departemen</label>
                    <select class="form-control" name="departemen" id="tampilDepartemen" disabled>
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
                    <label class="control-label col-sm-2" for="tampilPosisi">Posisi</label>
                    <input type="text" class="form-control" id="tampilPosisi" name="posisi" placeholder="Posisi Pekerjaan" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8" for="editTotalSimpanan">Total Simpanan</label>
                    <input type="number" class="form-control" name="totalSimpanan" id="tampilTotalSimpanan" placeholder="Total Simpanan" disabled>
                  </div>
                  </form>                  
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Tutup
                  </button>
                  </div>
              </div>
            </div>
          </div>
          <!-- Modal editAnggota -->
          <div id="editAnggota" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form">
                    <input type="hidden" name="id" id="editId" disabled>
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    <input type="text" class="form-control" name="no" id="editNoAnggota" placeholder="No Anggota" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="editNama">Nama</label>
                    <input type="text" class="form-control" id="editNama" name="nama" placeholder="Nama Anggota" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="editDepartemen">Departemen</label>
                    <select class="form-control" name="departemen" id="editDepartemen" required>
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
                    <label class="control-label col-sm-2" for="editPosisi">Posisi</label>
                    <input type="text" class="form-control" id="editPosisi" name="posisi" placeholder="Posisi Pekerjaan" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8" for="editTotalSimpanan">Total Simpanan</label>
                    <input type="number" class="form-control" name="totalSimpanan" id="editTotalSimpanan" placeholder="Total Simpanan">
                  </div>
                  </form>                  
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-info" id="updateAnggota">
                    <span class="fa fa-pencil"></span> Update
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Batal
                  </button>
                  </div>
              </div>
            </div>
          </div>
          <!-- Modal hapusAnggota -->
          <div id="hapusAnggota" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form">
                  <div class="form-group">
                    <label class="control-label col-sm-12 text-center"><b>Apakah anda yakin menghapus anggota ini?</b></label>  
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8">No Anggota</label>
                    <input type="text" class="form-control" name="no" id="hapusNoAnggota" placeholder="No Anggota" disabled>
                  </div>                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="hapusNama">Nama</label>
                    <input type="text" class="form-control" id="hapusNama" name="nama" placeholder="Nama Anggota" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="hapusDepartemen">Departemen</label>
                    <select class="form-control" name="departemen" id="hapusDepartemen" disabled>
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
                    <label class="control-label col-sm-2" for="hapusPosisi">Posisi</label>
                    <input type="text" class="form-control" id="hapusPosisi" name="posisi" placeholder="Posisi Pekerjaan" disabled>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-8" for="hapusTotalSimpanan">Total Simpanan</label>
                    <input type="number" class="form-control" name="totalSimpanan" id="hapusTotalSimpanan" placeholder="Total Simpanan" disabled>
                  </div>
                  </form>                  
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-danger" id="buangAnggota">
                    <span class="fa fa-trash"></span> Hapus
                  </button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="fa fa-close"></span> Batal
                  </button>
                  </div>
              </div>
            </div>
          </div>
@endsection