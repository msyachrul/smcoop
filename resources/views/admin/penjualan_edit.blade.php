<?php date_default_timezone_set('Asia/Jakarta'); ?>

@extends('layouts.layout')

@section('breadcrumb','Penjualan')

@section('content')
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-plus-square"></i> Form Edit Penjualan
			<div class="pull-right">
				<a href="{{ URL::asset('/admin/penjualan')}}" class="btn btn-success btn-sm"><i class="fa fa-angle-double-left"></i> Kembali</a>
			</div>
		</div>
		<div class="card-body">
			<form role="form">
			{{ csrf_field() }}
			<input type="hidden" name="no" value="{{ $penjualan->no }}" required>
			<label for="tanggal">Tanggal /</label>
			<label>No Penjualan</label>
			<div class="form-row">
				<div class="form-group col-sm-2">
					<input type="text" class="form-control form-control-sm" name="tanggal" value="{{ $penjualan->tanggal }}" required disabled>
				</div>
				<div class="form-group col-sm-2">
					<input type="text" class="form-control form-control-sm" name="no" value="{{ $penjualan->no }}" required disabled>
				</div>
			</div>
			<label for="namaAnggota">Anggota</label>
			<div class="form-row">
			    <div class="form-group col-sm-2">
					<input type="text" class="e_penjualanNoAnggota form-control form-control-sm" name="anggota_no" value="{{ $penjualan->anggota_no }}" disabled required>
			    </div>
			    <div class="form-group col-sm">
				    <input type="text" class="e_penjualanNamaAnggota form-control form-control-sm" id="namaAnggota" value="{{ $penjualan->nama }}" disabled required>
			    </div>
			</div>
			<label for="namaBarang">Barang</label>
			<div class="form-row">
			    <div class="form-group col-sm-2">
				    <input type="text" class="i_penjualanIdBarang form-control form-control-sm" name="barang_id" placeholder="No Barang" disabled required>
				</div>
				<div class="form-group col-sm">
				    <input type="text" class="i_penjualanNamaBarang form-control form-control-sm" id="namaBarang" placeholder="Nama Barang" required>
				</div>
				<div class="form-group col-sm-2">
					<input type="number" class="e_penjualanKuantitas form-control form-control-sm" name="kuantitas" id="kuantitas" placeholder="Kuantitas" value="1">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm">
					<div class="pull-right">
						<a href="#" class="btn btn-primary btn-sm" id="e_penjualanInputBarang"><i class="fa fa-plus"></i> Tambah</a>
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
						<?php $i=1; ?>
						@foreach($detail as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->nama }}</td>
							<td class="text-right">{{ $value->kuantitas }}</td>
							<td class="text-right">Rp {{ number_format($value->subTotal) }}</td>
							<td>
								<a href="#" class="e_hapusPenjualanBarang btn btn-danger btn-sm" data-barang_id="{{ $value->barang_id }}" data-nama="{{ $value->nama }}" data-kuantitas="{{ $value->kuantitas }}"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="3"><b>Total</b></td>
							<td class="detailTotal text-right">
								Rp {{ number_format($penjualan->total) }}
								<input type="hidden" class="e_penjualanHiddenTotal" name="total" value="{{ $penjualan->total }}" required disabled>
							</td>
					    	<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Modal hapusPenjualanBarang -->
	<div id="e_hapusPenjualanBarang" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<input type="hidden" class="hapusPenjualanIdBarang" name="barang_id">
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
					<button type="submit" class="_e_hapusPenjualanBarang btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
				</div>
			</div>
		</div>
	</div>
@endsection