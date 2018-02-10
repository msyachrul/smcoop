@extends('layouts.layout')

@section('breadcrumb','Penjualan')

@section('content')
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-plus-square"></i> Form Input Penjualan
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<form role="form">
					<table class="table" width="100%" cellspacing="0">
						<tr>
							<td colspan="2">
								<label class="control-label">No Transaksi</label>
								<input type="text" class="form-control" name="noTransaksi" disabled>
							</td>
							<td>
								<label class="control-label">Tanggal</label>
								<input type="date" class="tanggal form-control" name="tanggal" id="tanggal">
							</td>
						</tr>
						<tr>
							<td>
								<label class="control-label">Nama Anggota</label>
								<input type="text" class="anggota_nama form-control" name="anggota_nama" id="anggota_nama">
							</td>
							<td>
								<label class="control-label">Nama Barang</label>
								<input type="text" class="barang_nama form-control" name="barang_nama" id="barang_nama">
							</td>
							<td>
								<label class="control-label">Kuantitas</label>
								<input type="number" class="kuantitas form-control" name="kuantitas" id="kuantitas">
							</td>
						</tr>
					</table>
				</form>
				<div class="pull-right">
				<a href="#" class="inputPenjualan btn btn-primary"><i class="fa fa-save"></i> Simpan</a>
				</div>
			</div>
		</div>
	</div>
@endsection