@extends('layouts.layout')

@section('breadcrumb','Pembelian')

@section('content')

	<div class="card mb-3">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%"><b>No Anggota</b></td>
						<td width="1%">:</td>
						<td width="39%">{{ $data[0]->anggota_no }}</td>
						<td><b>Total Simpanan</b></td>
						<td>:</td>
						<td>Rp {{ number_format($data[0]->totalSimpanan) }}</td>
					</tr>
					<tr>
						<td><b>Nama</b></td>
						<td>:</td>
						<td>{{ $data[0]->nama }}</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><b>Keanggotaan</b></td>
						<td>:</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th>Tanggal</th>
							<th>No Transaksi</th>
							<th class="text-right">Total</th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($data as $key => $value)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $value->tanggal }}</td>
							<td>{{ $value->penjualan_no }}</td>
							<td class="text-right">Rp {{ number_format($value->total) }}</td>
							<td><a class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection