@extends('layouts.layout')

@section('breadcrumb','Penjualan/Detail')

@section('content')
	
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-table"></i> Detail Penjualan
			<div class="pull-right">
				<a href="{{ URL::asset('/admin/penjualan')}}" class="btn btn-success btn-sm"><i class="fa fa-angle-double-left"></i> Kembali</a>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%"><b>No Transaksi</b></td>
						<td width="1%">:</td>
						<td width="39%">{{ $penjualan->no }}</td>
						<td><b>Tanggal</b></td>
						<td width="1%">:</td>
						<td>{{ $penjualan->tanggal }}</td>
					</tr>
					<tr>
						<td><b>No Anggota</b></td>
						<td>:</td>
						<td colspan="4">{{ $penjualan->anggota_no }}</td>
					</tr>
					<tr>
						<td><b>Nama</b></td>
						<td>:</td>
						<td>{{ $penjualan->nama }}</td>
						<td><b>Total</b></td>
						<td>:</td>
						<td>Rp {{ number_format($penjualan->total) }}</td>
					</tr>
				</table>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th width="40%">Nama</th>
							<th width="15%" class="text-right">Harga</th>
							<th width="15%" class="text-right">Kuantitas</th>
							<th width="25%" class="text-right">SubTotal</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($detail as $key => $value)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $value->nama }}</td>
							<td class="text-right">Rp {{ number_format($value->harga) }}</td>
							<td class="text-right">{{ $value->kuantitas }}</td>
							<td class="text-right">Rp {{ number_format($value->subTotal) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	

@endsection