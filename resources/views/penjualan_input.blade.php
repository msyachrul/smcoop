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
				<div class="form-group row">
					<input type="hidden" class="form-control form-control-sm" name="noPenjualan" value="{{ $noPenjualan }}" required>
					<label for="tanggal" class="col-sm-1 col-form-label col-form-label-sm">Tanggal</label>
					<div class="col-sm-2">
						<input type="date" class="form-control form-control-sm" name="tanggal" required>
					</div>
					<div class="col-sm">
						<a href="#" class="btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> Simpan Transaksi</a>
					</div>
				</div>
				<div class="form-group row">
				    <label for="namaAnggota" class="col-sm-1 col-form-label col-form-label-sm">Anggota</label>
				    <div class="col-sm-3">
						<input type="text" class="i_penjualanIdAnggota form-control form-control-sm" placeholder="No Anggota" disabled required>
				    </div>
				    <div class="col-sm">
					    <input type="text" class="i_penjualanNamaAnggota form-control form-control-sm" id="namaAnggota" placeholder="Nama Anggota" required>
				    </div>
				</div>
				<div class="form-group row">
				    <label for="namaBarang" class="col-sm-1 col-form-label col-form-label-sm">Barang</label>
				    <div class="col-sm-3">
					    <input type="text" class="i_penjualanIdBarang form-control form-control-sm" placeholder="No Barang" disabled required>
					</div>
					<div class="col-sm">
					    <input type="text" class="i_penjualanNamaBarang form-control form-control-sm" id="namaBarang" placeholder="Nama Barang" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="kuantitas" class="col-sm-1 col-form-label col-form-label-sm">Kuantitas</label>
					<div class="col-sm-3">
						<input type="number" class="form-control form-control-sm" id="kuantitas" placeholder="Kuantitas" required>
					</div>
				    <label for="total" class="col-sm-1 col-form-label col-form-label-sm">Total</label>
				    <div class="col-sm">
			    		<input type="number" class="form-control form-control-sm" placeholder="Total" disabled required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm">
						<div class="pull-right">
							<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
							<a href="{{ URL::asset('penjualan') }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Batal</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection