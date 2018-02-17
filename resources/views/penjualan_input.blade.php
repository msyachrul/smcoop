<?php date_default_timezone_set('Asia/Jakarta'); ?>

@extends('layouts.layout')

@section('breadcrumb','Penjualan')

@section('content')
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-plus-square"></i> Form Input Penjualan
		</div>
		<div class="card-body">
			<form role="form">
				{{ csrf_field() }}
				<label for="tanggal">Tanggal</label>
				<div class="form-group row">
					<div class="col-sm-2">
						<input type="date" class="form-control form-control-sm" name="tanggal" value="{{ date('Y-m-d') }}" required>
					</div>
					<div class="col-sm">
						<a href="#" class="i_penjualan btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> Simpan Transaksi</a>
					</div>
				</div>
				<label for="namaAnggota">Anggota</label>
				<div class="form-group row">
				    <div class="col-sm-2">
				    	<input type="hidden" class="i_penjualanIdAnggota" name="anggota_id" required>
						<input type="text" class="i_penjualanNoAnggota form-control form-control-sm" name="anggota_noAnggota" placeholder="No Anggota" disabled required>
				    </div>
				    <div class="col-sm">
					    <input type="text" class="i_penjualanNamaAnggota form-control form-control-sm" id="namaAnggota" placeholder="Nama Anggota" required>
				    </div>
				    <div class="enable_penjualanNamaAnggota col-sm-1">
				    	<a href="#" class="enable_penjualanNamaAnggota btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
				    </div>
				</div>
				<label for="namaBarang">Barang /</label>
				<label for="kuantitas">Kuantitas</label>
				<div class="form-group row">
				    <div class="col-sm-2">
					    <input type="text" class="i_penjualanIdBarang form-control form-control-sm" name="barang_id" placeholder="No Barang" disabled required>
					</div>
					<div class="col-sm">
					    <input type="text" class="i_penjualanNamaBarang form-control form-control-sm" id="namaBarang" placeholder="Nama Barang" required>
					</div>/
					<div class="col-sm-2">
						<input type="number" class="i_penjualanKuantitas form-control form-control-sm" name="kuantitas" id="kuantitas" placeholder="Kuantitas" value="1">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm">
						<div class="pull-right">
							<a href="#" class="btn btn-primary btn-sm" id="penjualanInputBarang"><i class="fa fa-plus"></i> Tambah</a>
							<a href="#" class="btn btn-danger btn-sm" id="batalInputPenjualan"><i class="fa fa-close"></i> Batal</a>
						</div>
					</div>
				</div>
			</form>
			<div class="table-responsive" id="reloadTable">
				<table class="table table-bordered" id="barangTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Nama Barang</th>
							<th width="10%">Kuantitas</th>
							<th class="text-right">Sub total</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<tbody id="tbodyPenjualanBarang">
						<?php $no=1; ?>
						@foreach($tmpBarang as $key => $value)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $value->nama }}</td>
							<td class="text-right">{{ $value->kuantitas }}</td>
							<td class="text-right">Rp {{ number_format($value->subTotal) }}</td>
							<td>
								<a href="#" class="hapusPenjualanBarang btn btn-danger btn-sm" data-id="{{ $value->id }}" data-nama="{{ $value->nama }}" data-kuantitas="{{ $value->kuantitas }}"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="3"><b>Total</b></td>
							<td class="detailTotal text-right">
								Rp {{ number_format($tmpTotal) }}
								<input type="hidden" name="noPenjualan" value="{{ $noPenjualan }}" required>
								<input type="hidden" class="i_penjualanHiddenTotal" name="total" value="{{ $tmpTotal }}" required disabled>
							</td>
					    	<td></td>
			    		</div>
					</div>
				</div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Modal hapusPenjualanBarang -->
	<div id="hapusPenjualanBarang" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<input type="hidden" class="hapusPenjualanIdBarang" name="id">
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Barang</label>
							<input type="text" class="hapusPenjualanNamaBarang form-control" disabled>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Kuantitas</label>
							<input type="number" class="hapusPenjualanKuantitasBarang form-control" disabled>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" class="_hapusPenjualanBarang btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>
@endsection