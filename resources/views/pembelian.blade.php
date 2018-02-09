<?php date_default_timezone_set("Asia/Jakarta") ?>

@extends('layouts.layout')

@section('breadcrumb','Pembelian')

@section('content')

      {{ csrf_field() }}
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Pembelian <span id="keteranganTanggal">Hari ini <b>{{ date('Y-m-d') }}</b></span>
          <a href="#" class="cariData btn btn-success btn-sm pull-right"><i class="fa fa-search"></i></a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th class="text-right">Harga</th>
                  <th class="text-right">Kuantitas</th>
                  <th class="text-right">Sub Total</th>
                  <th width="10%" class="text-center">
                    <a href="#" class="inputPembelian btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                  </th>
                </tr>
              </thead>
              <tbody id="tbodyCari">
                <?php $i=1; ?>
                @foreach($pembelian as $key => $value)
                <tr class="pembelian">
                  <td>{{ $i++ }}</td>
                  <td>{{ $value->tanggal }}</td>
                  <td>{{ $value->nama }}</td>
                  <td class="text-right">Rp {{ number_format($value->harga) }}</td>
                  <td class="text-right">{{ $value->kuantitas }}</td>
                  <td class="text-right">Rp {{ number_format($value->harga*$value->kuantitas) }}</td>
                  <td>
                    <a href="#" class="editPembelian btn btn-info btn-sm" data-id="{{ $value->id }}" data-tanggal="{{ $value->tanggal }}" data-nama="{{ $value->nama }}" data-harga="{{ $value->harga }}" data-kuantitas="{{ $value->kuantitas }}" data-barang_id="{{ $value->barang_id }}"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="hapusPembelian btn btn-danger btn-sm" data-id="{{ $value->id }}" data-tanggal="{{ $value->tanggal }}" data-nama="{{ $value->nama }}" data-harga="{{ $value->harga }}" data-kuantitas="{{ $value->kuantitas }}" data-barang_id="{{ $value->barang_id }}"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <!-- Modal inputPembelian -->
    <div id="inputPembelian" class="modal fade" role="dialog">
      	<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h4 class="modal-title"></h4>
      				<button type="button" class="close" data-dismiss="modal">&times;</button>
      			</div>
      			<div class="modal-body">
      				<form class="form-horizontal" role="form">
      					<div class="form-group">
      						<label class="control-label col-sm-6">Tanggal</label>
      						<input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" required>
      					</div>
                <div class="form-group ui-front">
                  <label class="control-label col-sm-6">ID Barang</label>
                  <input type="text" class="idBarang form-control" name="barang_id" id="barang_id" disabled>
                </div>
      					<div class="form-group ui-front">
      						<label class="control-label col-sm-6">Nama Barang</label>
      						<input type="text" class="namaBarang form-control" id="namaBarang" required>
      					</div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Harga</label>
                  <input type="number" class="form-control" name="harga" id="harga" required>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Kuantitas</label>
                  <input type="number" class="form-control" name="kuantitas" id="kuantitas" required>
                </div>
      				</form>
      			</div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="_inputPembelian">
                <span class="fa fa-plus"></span> Input
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class="fa fa-close"></span> Batal
              </button>
            </div>
      		</div>
      	</div>
    </div>
    <!-- Modal editPembelian -->
    <div id="editPembelian" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-sm-6">Tanggal</label>
                  <input type="hidden" name="id" id="editId">
                  <input type="date" class="form-control" name="tanggal" id="editTanggal" disabled>
                </div>
                <div class="form-group ui-front">
                  <label class="control-label col-sm-6">ID Barang</label>
                  <input type="text" class="form-control" name="barang_id" id="editBarang_id" disabled>
                </div>
                <div class="form-group ui-front">
                  <label class="control-label col-sm-6">Nama Barang</label>
                  <input type="text" class="form-control" id="editNamaBarang" disabled>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Harga</label>
                  <input type="number" class="form-control" name="harga" id="editHarga" required>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Kuantitas</label>
                  <input type="number" class="form-control" name="kuantitas" id="editKuantitas" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info" id="_editPembelian">
                <span class="fa fa-check"></span> Input
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class="fa fa-close"></span> Batal
              </button>
            </div>
          </div>
        </div>
    </div>
    <!-- Modal hapusPembelian -->
    <div id="hapusPembelian" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-sm-12 text-center"><b>Apakah anda yakin menghapus data pembelian ini?</b></label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Tanggal</label>
                  <input type="hidden" name="id" id="hapusId">
                  <input type="date" class="form-control" name="tanggal" id="hapusTanggal" disabled>
                </div>
                <div class="form-group ui-front">
                  <label class="control-label col-sm-6">ID Barang</label>
                  <input type="text" class="form-control" name="barang_id" id="hapusBarang_id" disabled>
                </div>
                <div class="form-group ui-front">
                  <label class="control-label col-sm-6">Nama Barang</label>
                  <input type="text" class="form-control" id="hapusNamaBarang" disabled>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Harga</label>
                  <input type="number" class="form-control" name="harga" id="hapusHarga" disabled>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Kuantitas</label>
                  <input type="number" class="form-control" name="kuantitas" id="hapusKuantitas" disabled>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" id="_hapusPembelian">
                <span class="fa fa-trash"></span> Hapus
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class="fa fa-close"></span> Batal
              </button>
            </div>
          </div>
        </div>
    </div>
    <!-- Modal pilih tanggal -->
    <div id="cariData" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="control-label col-sm-6">Dari</label>
                  <input type="date" class="form-control" name="dariTanggal" id="dariTanggal" required>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6">Sampai</label>
                  <input type="date" class="form-control" name="sampaiTanggal" id="sampaiTanggal" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info" id="_cariData">
                <span class="fa fa-search"></span> Cari
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class="fa fa-close"></span> Batal
              </button>
            </div>
        </div>
      </div>
    </div>

@endsection